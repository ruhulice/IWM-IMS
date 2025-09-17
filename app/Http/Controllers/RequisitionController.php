<?php

namespace App\Http\Controllers;

use App\Mail\MailNotification;
use App\Models\ApprovalFlow;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Division;
use App\Models\Employees;
use App\Models\Project;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RequisitionInfo;
use App\Models\RequisitionDetails;
use App\Models\Status;
use App\Models\Uploaddocuments;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class RequisitionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::all();
        $category = Category::whereIn('categoryid', ['CM','CP','CS','CE','CA'])->get();
        $statues = Status::all();
        $Loginuser = Auth::user();

        $statusid = 1;
        $statusidList = []; // for RUH

        // Determine status filter based on user
        if ($Loginuser->user_name === "MMM") {
            $statusid = 1;
        } elseif ($Loginuser->user_name === "ALD") {
            $statusid = 2;
        } elseif ($Loginuser->user_name === "MAI") {
            $statusid = 3;
        } elseif ($Loginuser->user_name === "SMR") {
            $statusid = 4;
        } elseif ($Loginuser->user_name === "RUH") {
            $statusidList = [1, 2, 3, 4, 5];
        }

        // Build base query
        $query = DB::table('requisitioninfo as reqi')
            ->join('requisitiondetails as reqd', 'reqi.id', '=', 'reqd.requisitionid')
            ->join('category as c', 'reqd.categoryid', '=', 'c.id')
            ->join('subcategory as sc', 'reqd.subcategoryid', '=', 'sc.id')
            ->join('users as u', 'reqi.requisitionby', '=', 'u.id')
            ->join('division as d', 'reqd.divisionid', '=', 'd.divisionid')
            ->join('statuses as s', DB::raw('CAST(reqi.status AS INTEGER)'), '=', 's.id')
            ->select(
                'reqi.id',
                'reqi.requisitionby',
                'u.name',
                'u.user_name',
                'reqi.requisitiondate',
                'reqi.status as status_id',
                's.status as status',
                'reqi.reqpurpose',
                'reqd.divisionid',
                'd.divisionname',
                'reqd.projectno',
                'reqd.empinitial',
                'reqd.categoryid',
                'c.categoryname',
                'reqd.subcategoryid',
                'sc.subcategoryname',
                'reqd.techspecification',
                'reqd.rate',
                'reqd.quantity',
                'reqd.uom',
                'reqd.price'
            );

        // Apply status filter
        if (!empty($statusidList)) {
            $query->whereIn('reqi.status', $statusidList);
        } else {
            $query->where('reqi.status', $statusid);
        }

        $requisitions = $query->orderBy('reqi.id', 'desc')->get();

        return view('requisitions.index', compact('users', 'category', 'requisitions', 'statues'));
    }

    public function getTransferList(Request $request)
    {
        dd("List");
        // $tr_data = (new Transfer())->newQuery();

        // if ($request->input('equipment_id')) {
        //     $tr_data->where('equipment_id', $request->input('equipment_id'));
        // }
        // if ($request->input('status_id')) {
        //     $tr_data->where('status_id', $request->input('status_id'));
        // }
        // if ($request->input('to_user_id')) {
        //     $tr_data->where('to_user_id', $request->input('to_user_id'));
        // }

        // $results = $tr_data->orderBy('id', 'asc')->get();
        $results = "";

        return view('transfer.filter_data', compact('results'));
    }

    public function create()
    {
        // dd("Create");
        $category = Category::whereIn('categoryid', ['CM','CP','CS','CE','CA'])->get();
        $divisions  = Division::all();
        $initial = Employees::where('employmentstatusid', '=', 1)->orderBy("employeeinitial", "asc")->get();

        // $users      = User::select('users.*')->leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')->where('user_roles.role_id', 5)->where('users.is_active', true)->get();

        // return view('transfer.create', compact('subcategory','equipments', 'conditions', 'divisions', 'statues', 'users','divisions'));
        $users = User::all();
        return view('requisitions.create', compact('users', 'category', 'divisions', 'initial'));
    }
    public function store(Request $request)
    {
        $userid = Auth::user()->id;

        // Validation
        $request->validate([
            'requisitiondate'   => 'required|date',
            'reqpurpose'        => 'nullable|string',
            'divisionid'        => 'required|array',
            'projectno'         => 'required|array',
            'categoryid'        => 'required|array',
            'subcategoryid'     => 'required|array',
            'techspecification' => 'required|array',
            'quantity'          => 'required|array',
            'rate'              => 'required|array',
            'price'             => 'required|array',
            'empinitial'        => 'nullable|array',
            'pdffile'           => 'nullable|mimes:pdf,msg|max:20480',
        ]);

        try {
            DB::transaction(function () use ($request, $userid) {

                // Insert into master
                $requisition = RequisitionInfo::create([
                    'requisitiondate' => $request->requisitiondate,
                    'requisitionby'   => $userid,
                    'status'          => 1,
                    'totalamount'     => 0, // will update later
                    'reqpurpose'      => $request->reqpurpose,
                    'created_at'      => now(),
                ]);

                $totalAmount = 0;

                // Insert into child table
                foreach ($request->categoryid as $key => $value) {
                    $price = $request->price[$key] ?? 0;
                    $totalAmount += $price;

                    RequisitionDetails::create([
                        'requisitionid'     => $requisition->id,
                        'categoryid'        => $request->categoryid[$key],
                        'subcategoryid'     => $request->subcategoryid[$key],
                        'techspecification' => $request->techspecification[$key],
                        'divisionid'        => $request->divisionid[$key],
                        'projectno'         => $request->projectno[$key],
                        'empinitial'        => $request->empinitial[$key] ?? null,
                        'quantity'          => $request->quantity[$key],
                        'uom'               => 'Nos.',
                        'rate'              => $request->rate[$key],
                        'price'             => $price,
                        'created_at'        => now(),
                    ]);
                }

                // Update total amount in master
                $requisition->update(['totalamount' => $totalAmount]);

                // Create approval flow
                $appflow = ApprovalFlow::create([
                    'documenttypeid'   => 1,
                    'documentid'       => $requisition->id,
                    'projectno'        => $request->projectno[0] ?? null,
                    'submitdate'       => now()->toDateString(),
                    'statusid'         => 1,
                    'approvalpathid'   => 1,
                    'fromauthorid'     => $userid,
                    'toauthorid'       => 3,
                    'comments'         => '',
                    'iscurrentflow'    => true,
                ]);

                // Handle file upload
                if ($request->hasFile('pdffile')) {
                    $file = $request->file('pdffile');
                    if ($file->isValid()) {
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $filePath = $file->storeAs('public/pdfs', $fileName);

                        Uploaddocuments::create([
                            'name'         => $fileName,
                            'path'         => str_replace('public/', '', $filePath),
                            'documenttype' => 1, // 1=PDF, 2=MSG
                            'documentid'   => $requisition->id,
                            'uploadby'     => $userid,
                            'uploaddate'   => now(),
                        ]);
                    } else {
                        throw new \Exception('Uploaded file is not valid.');
                    }
                }
            });

            return redirect()->route('admin.requisitions.index')
                             ->with('success', 'Requisition created successfully.');

        } catch (\Exception $e) {
            Log::error('Requisition creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to save requisition: ' . $e->getMessage());
        }
    }


    // public function store(Request $request)
    // {
    //     // dd($request);
    //     $userid = Auth::user()->id;

    //     $request->validate([
    //     'requisitiondate' => 'required|date',
    //     'reqpurpose'      => 'nullable|string',
    //     'divisionid'      => 'required|array',
    //     'projectno'       => 'required|array',
    //     'categoryid'      => 'required|array',
    //     'subcategoryid'   => 'required|array',
    //     'techspecification' => 'required|array',
    //     'quantity'        => 'required|array',
    //     'rate'            => 'required|array',
    //     'price'           => 'required|array',
    //     'empinitial'      => 'nullable|array',
    //     'pdffile'         => 'nullable|mimes:pdf,msg|max:20480', // max 20MB
    //      ]);



    //     try {
    //         DB::transaction(function () use ($request, $userid) {
    //             // Insert into master
    //             $requisition = RequisitionInfo::create([
    //                 'requisitiondate' => $request->requisitiondate,
    //                 'requisitionby' => $userid,
    //                 'status' => 1,
    //                 'totalamount' => 0,
    //                 'reqpurpose' => $request->reqpurpose,
    //                 'created_at' => Carbon::now(),
    //             ]);

    //              $totalAmount = 0;

    //                // Insert into child table
    //             foreach ($request->categoryid as $key => $value) {
    //                 $price = $request->price[$key] ?? 0;
    //                 $totalAmount += $price;

    //                 RequisitionDetails::create([
    //                     'requisitionid'     => $requisition->id,
    //                     'categoryid'        => $request->categoryid[$key],
    //                     'subcategoryid'     => $request->subcategoryid[$key],
    //                     'techspecification' => $request->techspecification[$key],
    //                     'divisionid'        => $request->divisionid[$key],
    //                     'projectno'         => $request->projectno[$key],
    //                     'empinitial'        => $request->empinitial[$key] ?? null,
    //                     'quantity'          => $request->quantity[$key],
    //                     'uom'               => 'Nos.',
    //                     'rate'              => $request->rate[$key],
    //                     'price'             => $price,
    //                     'created_at'        => Carbon::now(),
    //                 ]);

    //             $appflow = new ApprovalFlow();
    //             $appflow->documenttypeid = 1;
    //             $appflow->documentid = $requisition->id;
    //             $appflow->projectno = $requisition->projectno;
    //             $appflow->submitdate = Carbon::now()->toDateString();
    //             $appflow->statusid = 1;
    //             $appflow->approvalpathid = 1;
    //             $appflow->fromauthorid =  $userid;
    //             $appflow->toauthorid = 3;
    //             $appflow->comments = "";
    //             $appflow->iscurrentflow = true;

    //             $appflow->save();

    //             // Save file data and storage PDF/MSG
    //             if ($request->hasFile('pdffile')) {
    //                 $file = $request->file('pdffile');

    //                 if ($file->isValid()) {
    //                     // Allowed extensions
    //                     $allowedExtensions = ['pdf', 'msg'];

    //                     // Get file extension
    //                     $extension = strtolower($file->getClientOriginalExtension());

    //                     if (!in_array($extension, $allowedExtensions)) {
    //                         return back()->with('error', 'Only PDF and MSG files are allowed.');
    //                     }

    //                     // Unique file name
    //                     $fileName = time() . '_' . $file->getClientOriginalName();

    //                     // Store in storage/app/public/uploads
    //                     $filePath = $file->storeAs('public/pdfs', $fileName);
    //                     //$filePath = $file->storeAs('public/uploads', $fileName);

    //                     // Save path to database
    //                     $document = new Uploaddocuments();
    //                     $document->name = $fileName;
    //                     $document->path = str_replace('public/', '', $filePath);
    //                     $document->documenttype = 1; //($extension === 'pdf') ? 1 : 2; // 1=PDF, 2=MSG
    //                     $document->documentid = $requisition->id;
    //                     $document->uploadby = $request->requisitionby;
    //                     $document->uploaddate = Carbon::now();
    //                     $document->save();

    //                 } else {
    //                     return back()->with('error', 'Uploaded file is not valid.');
    //                 }
    //             }


    //         });



    //         return redirect()->route('admin.requisitions.index')
    //                         ->with('success', 'Requisition created successfully.');
    //     } catch (\Exception $e) {
    //         //dd($e->getMessage());
    //         Log::error('Requisition creation failed: ' . $e->getMessage());

    //         return back()->with('error', 'Failed to save requisition: ' . $e->getMessage());
    //     }

    // }

    public function edit($id)
    {
        dd("Edit");
        // $result     = Transfer::findOrFail($id);
        // $equipments = Equipment::whereIn('category_id', [16, 17])->whereIn('asset_condition_id', [1, 2])->get();
        // $conditions = AssetCondition::all();
        // $divisions  = BdDivision::all();
        // $districts  = BdDistrict::where('bd_division_code', $result->division_code)->get();
        // $upazilas   = BdUpazila::where('bd_district_code', $result->district_code)->get();
        // $statues    = Status::all();
        // $users      = User::all();

        //return view('requisitions.edit', compact('result', 'equipments', 'conditions', 'divisions', 'districts', 'upazilas', 'statues', 'users'));
        return view("--");
    }

    public function update(Request $request, $id)
    {
        // dd($request->approver_comment);
        $requisition = RequisitionInfo::where('id', $id)->first();
        $approvalflow = ApprovalFlow::where('documentid', $id) ->where('documenttypeid', 1)
                        ->where('iscurrentflow', true)->first();
        //dd($approvalflow);
        $user = Auth::user();
        //dd($user);
        // Determine the next approver and status
        $toauthorid = $user->id;
        $statusid = 1;
        $appverpathid = 1;
        $reqemail = DB::table('users as u')
            ->join('approvalflow as af', 'u.id', '=', 'af.fromauthorid')
            ->where('u.id', $approvalflow->fromauthorid)
            ->where('af.approvalpathid', 1)
            ->value('u.email');
        // dd($reqemail);
        $manageremail = DB::table('users as u')
            ->join('approvalflow as af', 'u.id', '=', 'af.toauthorid')
            ->where('u.id', $approvalflow->toauthorid)
            ->where('af.approvalpathid', 1)
            ->value('u.email');
        //dd($manageremail);

        if ($requisition->status == 1 && $approvalflow->toauthorid = $user->id) {
            // dd($toemail);
            $toauthorid = 3;
            $statusid = 2;
            $appverpathid = 2;
            // $toemail = null;
            $toemail = User::where('id', $toauthorid)->value('email');
        } elseif ($requisition->status == 2 && $approvalflow->toauthorid = $user->id) {
            // dump($user->user_name);
            $toemail = User::where('id', $approvalflow->toauthorid)->value('email');
            $toauthorid = 6;
            $statusid = 3;
            $appverpathid = 3;
            $toemail = User::where('id', $toauthorid)->value('email');
        } elseif ($requisition->status == 3 && $approvalflow->toauthorid = $user->id) {
            // dump($user->user_name);
            $toauthorid = 6;
            $statusid = 4;
            $appverpathid = 4;
            $toemail = User::where('id', $toauthorid)->value('email');
        } elseif ($requisition->status == 4 && $approvalflow->toauthorid = $user->id) {
            // dump($user->user_name);
            $toauthorid = 5;
            $statusid = 5;
            $appverpathid = 5;
            $toemail = User::where('id', $toauthorid)->value('email');
        }
        // Update Requisitioninfo
        $requisition->status =  $statusid ;
        $requisition->save();
        //Update Approval Flow
        $approvalflow->iscurrentflow = false;
        $approvalflow->save();

        $appflow = new ApprovalFlow();
        $appflow->documenttypeid = 1;
        $appflow->documentid = $requisition->id;
        $appflow->projectno = $requisition->projectno;
        $appflow->submitdate = Carbon::now()->toDateString();
        $appflow->statusid = $statusid;
        $appflow->approvalpathid =  $appverpathid;
        $appflow->fromauthorid = Auth::user()->id;
        $appflow->toauthorid = $toauthorid;
        $appflow->approvedate = Carbon::now();
        $appflow->comments = $request->approver_comment;
        $appflow->iscurrentflow = true;
        $appflow->save();
        // Prepare email details
        // Prepare email details
        $details = [
            'title' => 'Requisition approval Pending',
            //'body'  => 'Hello, your request #' . $id . ' was approved successfully.'
            'body'  => 'You have a pending request http://127.0.0.1:8005/admin/requisitions/'.$id . ' for approval'
        ];

        // Send plain text email
        Mail::raw($details['body'], function ($message) use ($toemail, $reqemail, $manageremail) {
            $message->to($toemail)
                    ->cc([$reqemail,$manageremail, 'ruh@iwmbd.org'])
                    ->subject('Approval Notification');
        });

        return redirect()->route('admin.requisitions.index')->with(['message' => 'Equipment transfer updated successfully.']);


        // return redirect()->back()->with('success', 'Data approved and email sent!');
    }

    public function show($id)
    {
        $requisitions = DB::table('requisitioninfo as reqi')
             ->join('requisitiondetails as reqd', 'reqi.id', '=', 'reqd.requisitionid')
             ->join('category as c', 'reqd.categoryid', '=', 'c.id')
             ->join('subcategory as sc', 'reqd.subcategoryid', '=', 'sc.id')
             ->join('users as u', 'reqi.requisitionby', '=', 'u.id')
             ->join('division as d', 'reqd.divisionid', '=', 'd.divisionid')
             ->join('statuses as s', DB::raw('CAST(reqi.status AS INTEGER)'), '=', 's.id')
             ->select(
                 'reqi.id',
                 'reqi.requisitionby',
                 'u.name',
                 'u.user_name',
                 'reqi.requisitiondate',
                 'reqi.status as status_id',
                 's.status as status',
                 'reqi.reqpurpose',
                 'reqd.divisionid',
                 'd.divisionname',
                 'reqd.projectno',
                 'reqd.empinitial',
                 'reqd.categoryid',
                 'c.categoryname',
                 'reqd.subcategoryid',
                 'sc.subcategoryname',
                 'reqd.techspecification',
                 'reqd.rate',
                 'reqd.quantity',
                 'reqd.uom',
                 'reqd.price'
             )->where('reqi.id', $id)->get();
        //Get attached PDF (if exists)
        $documents = DB::table('uploaddocuments')
            ->where('documenttype', 1)
            ->where('documentid', $id)
            ->orderByDesc('id')
            ->get();
        //dd($pdf);

        return view('requisitions.show', compact('requisitions', 'documents'));
    }


    public function getCategory()
    {
        // //dd($request);
        $category = Category::whereIn('categoryid', ['CM','CP','CS','CE','CA'])->pluck('categoryname', 'categoryid');
        return response()->json($category);
    }
    public function getSubCategory(Request $request)
    {

        $subcategory = SubCategory::where('categoryid', $request->categoryId)->pluck('subcategoryname', 'id');
        return response()->json($subcategory);
    }
    public function getProjects(Request $request)
    {
        $projects = Project::whereIn('projecttypeid', [2, 4])
        //->where('expectedenddate', '>=', Carbon::parse('2025-08-11'))
         ->where('expectedenddate', '>=', Carbon::now()->format('Y-m-d'))
        ->where('divisionid', $request->division_code)
        ->pluck('projectno', 'projecttitle');
        // $projects = Project::whereIn('projecttypeid', [2, 4])
        // ->where('divisionid', $request->division_code)
        // ->where('ExpectedEndDate', '>=', Carbon::now()->format('Y-m-d'))
        // ->pluck('projecttitle', 'projectno');
        //return $projects;
        // $projects = Project::where('divisionid', $request->division_code)->pluck('projectno', 'projecttitle');
        return response()->json($projects);

    }

    public function report($id)
    {
        $items = DB::table('requisitioninfo as reqi')
            ->join('requisitiondetails as reqd', 'reqi.id', '=', 'reqd.requisitionid')
            ->join('category as c', 'reqd.categoryid', '=', 'c.id')
            ->join('subcategory as sc', 'reqd.subcategoryid', '=', 'sc.id')
            ->join('users as u', 'reqi.requisitionby', '=', 'u.id')
            ->join('division as d', 'reqd.divisionid', '=', 'd.divisionid') // ✅ fixed here
            ->join('statuses as s', DB::raw('CAST(reqi.status AS INTEGER)'), '=', 's.id')
            ->select(
                'reqi.id',
                'reqi.requisitionby',
                'u.name',
                'u.user_name',
                'reqi.requisitiondate',
                'reqi.status as status_id',
                's.status as status',
                'reqi.reqpurpose',
                'reqd.divisionid',
                'd.divisionname',
                'reqd.projectno',
                'reqd.empinitial',
                'reqd.categoryid',
                'c.categoryname',
                'reqd.subcategoryid',
                'sc.subcategoryname',
                'reqd.techspecification',
                'reqd.rate',
                'reqd.quantity',
                'reqd.uom',
                'reqd.price'
            )->where('reqi.id', $id)->get();

        //Approval flow
        $approvalFlows = DB::table('approvalflow as af')
            ->join('users as u', 'af.fromauthorid', '=', 'u.id')
            ->join('statuses as s', 'af.statusid', '=', 's.id')
            ->select(
                'af.id',
                'af.fromauthorid',
                'u.user_name',
                'u.name',
                'u.designation',
                'af.statusid',
                's.status',
                'af.submitdate',
                'af.approvalpathid'
            )
            ->where('af.documentid', $id)
            ->where('af.statusid', '<>', 1)
            ->orderBy('af.id', 'asc')
            ->get();


        //return view('gate_pass.gate_pass_print', compact('items'));
        return view('requisitions.report', compact('items', 'approvalFlows'));
    }
}
