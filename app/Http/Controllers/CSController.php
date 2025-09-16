<?php

namespace App\Http\Controllers;

use App\Models\ApprovalFlow;
use App\Models\Category;
use App\Models\CSDetails;
use App\Models\CSInfo;
use App\Models\Division;
use App\Models\Status;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CSController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Get logged-in user
        $Loginuser = Auth::user();

        // Default status handling
        $statusid = 1;
        $statusidList = [];

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

        // Build query
        $query = DB::table('csinfo as c')
            ->join('csdetails as c2', 'c.id', '=', 'c2.csid')
            ->join('users as u', 'c.csby', '=', 'u.id')
            ->join('category as c3', 'c.categoryid', '=', 'c3.id')
            ->join('subcategory as s', 'c.subcategoryid', '=', 's.id')
            ->join('vendor as v', 'c2.vendorid', '=', 'v.id')
            ->join('division as d', 'c.divisionid', '=', 'd.divisionid')
            ->join('statuses as s2', 'c.status', '=', 's2.id')
            ->select(
                'c.id',
                'c2.id as csdid',
                'u.user_name',
                'u.name',
                'c.csdate',
                's2.status',
                'c.divisionid',
                'd.divisionname',
                'c.projectno',
                'c.categoryid',
                'c3.categoryname',
                'c.subcategoryid',
                's.subcategoryname',
                'c2.vendorid',
                'v.vendorname',
                'c2.techspecification',
                'c2.unitprice',
                'c2.quantity',
                'c2.subtotal',
                'c2.totalprice',
                'c2.filename',
                'c2.filepath',
                'c2.documenttype',
                'c2.documentid',
                'c2.uploaddate'
            )->where('vtype', 'IT');

        // Apply status filter
        if (!empty($statusidList)) {
            $query->whereIn('c.status', $statusidList);
        } else {
            $query->where('c.status', $statusid);
        }

        // Execute query
        $csData = $query->orderBy('c.id', 'desc')->get();

        $users = User::all();
        $category = Category::whereIn('categoryid', ['CM','CP','CS','CE','CA'])->get();
        $statues = Status::all();


        return view('cs.index', compact('users', 'category', 'statues', 'csData'));
    }
    public function create()
    {
        // dd("Create");
        $category = Category::whereIn('categoryid', ['CM','CP','CS','CE','CA'])->get();
        $divisions  = Division::all();
        $vendor =  Vendor::where('vtype', 'IT') ->orderBy('vendorname', 'asc')->get();

        // $users      = User::select('users.*')->leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')->where('user_roles.role_id', 5)->where('users.is_active', true)->get();

        // return view('transfer.create', compact('subcategory','equipments', 'conditions', 'divisions', 'statues', 'users','divisions'));
        $users = User::all();
        return view('cs.create', compact('users', 'category', 'divisions', 'vendor'));
    }

    public function store(Request $request)
    {
        $userid = Auth::user()->id;

        // Validate master & child fields
        $request->validate([
            'csdate'          => 'required|date',
            'divisionid'      => 'required|integer',
            'projectno'       => 'required|string',
            'reqpurpose'      => 'required|string',
            'categoryid.*'    => 'required|integer',
            'subcategoryid.*' => 'required|integer',
            'techspecification.*' => 'required|string',
            'quantity.*'      => 'required|numeric',
            'rate.*'          => 'required|numeric',
            'price.*'         => 'required|numeric',
            'pdffile.*'       => 'nullable|mimes:pdf|max:20480' // 20MB per file
        ]);

        try {
            DB::transaction(function () use ($request, $userid) {

                // Insert into master table (csinfo)
                $csinfo = CSInfo::create([
                    'csdate'     => $request->csdate,
                    'csby'       => $userid,
                    'divisionid' => $request->divisionid,
                    'projectno'  => $request->projectno,
                    'categoryid' => $request->categoryid,
                    'subcategoryid' => $request->subcategoryid,
                    'status'     => 1,
                    'reqpurpose' => $request->reqpurpose,
                ]);

                // Insert into child table (csdetails)
                foreach ($request->vendorid as $key => $value) {

                    $fileName = null;
                    $filePath = null;

                    // Handle file if exists
                    if ($request->hasFile('pdffile') && isset($request->file('pdffile')[$key])) {
                        $file = $request->file('pdffile')[$key];
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $filePath = $file->storeAs('csfiles', $fileName, 'public');
                    }

                    // Insert row
                    $csDetail = CSDetails::create([
                        'csid'              => $csinfo->id,
                        'vendorid'          => $request->vendorid[$key] ?? null,
                        'techspecification' => $request->techspecification[$key],
                        'unitprice'         => $request->rate[$key],
                        'quantity'          => $request->quantity[$key],
                        'subtotal'          => $request->quantity[$key] * $request->rate[$key],
                        'totalprice'        => $request->price[$key],
                        'remarks'           => $request->remarks[$key] ?? null,
                        'filename'          => $fileName,
                        'filepath'          => $filePath,
                        'documenttype'      => 2,
                        'uploaddate'        => now(),
                        'uploadby'          => $userid,
                        'documentid' => $csinfo->id,
                    ]);

                    // // Update documentid to its own ID
                    // $csDetail->update([
                    //     'documentid' => $csDetail->id,
                    // ]);
                }
                // Approval Flow insert
                $appflow = new ApprovalFlow();
                $appflow->documenttypeid = 2;
                $appflow->documentid = $csinfo->id;
                $appflow->projectno = $csinfo->projectno;
                $appflow->submitdate = Carbon::now()->toDateString();
                $appflow->statusid = 1;
                $appflow->approvalpathid = 1;
                $appflow->fromauthorid =  $userid;
                $appflow->toauthorid = 3;
                $appflow->comments = "";
                $appflow->iscurrentflow = true;

                $appflow->save();

            });


            return redirect()->route('admin.cs.index')
                             ->with('success', 'Requisition created successfully.');

        } catch (\Exception $e) {
            Log::error('Requisition creation failed: ' . $e->getMessage());

            return back()->with('error', 'Failed to save requisition: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        $csdata = DB::table('csinfo as c')
        ->join('csdetails as cd', 'c.id', '=', 'cd.csid')
        ->join('category as c2', 'c.categoryid', '=', 'c2.id')
        ->join('subcategory as s', 'c.subcategoryid', '=', 's.id')
        ->join('division as d', 'c.divisionid', '=', 'd.divisionid')
        ->join('users as u', 'c.csby', '=', 'u.id')
        ->join('vendor as v', 'cd.vendorid', '=', 'v.id')
        ->join('statuses as s2', 'c.status', '=', 's2.id')
        ->where('c.id', $id)
        ->select(
            'c.id',
            'u.user_name',
            'c.csdate',
            's2.status',
            'd.divisionname',
            'c.projectno',
            'c.reqpurpose',
            'c2.categoryname',
            's.subcategoryname',
            'v.vendorname',
            'cd.techspecification',
            'cd.unitprice',
            'cd.quantity',
            'cd.totalprice',
            'c.reqpurpose',
            'cd.filename',
            'cd.filepath',
            'cd.documenttype',
            'cd.documentid',
            'cd.uploadby'
        )
        ->get();

        // dd($csdata);

        return view('cs.show', compact('csdata'));
        // dd($id);
        // return  redirect()->route('admin.cs.index')->with('success', 'Show CS ');
    }
    public function update(Request $request, $id)
    {
        //dd($id);
        $csinfo = CSInfo::where('id', $id)->first();
        $approvalflow = ApprovalFlow::where('documentid', $id) ->where('documenttypeid', 2)
                        ->where('iscurrentflow', true)->first();
        //dd($approvalflow);
        $user = Auth::user();
        //dd($csinfo);
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

        if ($csinfo->status == 1 && $approvalflow->toauthorid = $user->id) {
            // dd($toemail);
            $toauthorid = 3;
            $statusid = 2;
            $appverpathid = 2;
            // $toemail = null;
            $toemail = User::where('id', $toauthorid)->value('email');
        } elseif ($csinfo->status == 2 && $approvalflow->toauthorid = $user->id) {
            // dump($user->user_name);
            $toemail = User::where('id', $approvalflow->toauthorid)->value('email');
            $toauthorid = 6;
            $statusid = 3;
            $appverpathid = 3;
            $toemail = User::where('id', $toauthorid)->value('email');
        } elseif ($csinfo->status == 3 && $approvalflow->toauthorid = $user->id) {
            // dump($user->user_name);
            $toauthorid = 6;
            $statusid = 4;
            $appverpathid = 4;
            $toemail = User::where('id', $toauthorid)->value('email');
        } elseif ($csinfo->status == 4 && $approvalflow->toauthorid = $user->id) {
            // dump($user->user_name);
            $toauthorid = 5;
            $statusid = 5;
            $appverpathid = 5;
            $toemail = User::where('id', $toauthorid)->value('email');
        }
        // Update Requisitioninfo
        $csinfo->status =  $statusid ;
        $csinfo->save();
        //Update Approval Flow
        $approvalflow->iscurrentflow = false;
        $approvalflow->save();

        $appflow = new ApprovalFlow();
        $appflow->documenttypeid = 2;
        $appflow->documentid = $csinfo->id;
        $appflow->projectno = $csinfo->projectno;
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
            'title' => 'CS approval Pending',
            //'body'  => 'Hello, your request #' . $id . ' was approved successfully.'
            'body'  => 'You have a pending request http://127.0.0.1:8001/admin/cs/'.$id . ' for approval'
        ];

        // Send plain text email
        Mail::raw($details['body'], function ($message) use ($toemail, $reqemail, $manageremail) {
            $message->to($toemail)
                    ->cc([$reqemail,$manageremail, 'ruh@iwmbd.org'])
                    ->subject('CS Approval Notification');
        });

        return redirect()->route('admin.cs.index')->with(['message' => 'Equipment transfer updated successfully.']);

    }
    public function report($id)
    {
        // dd($id);

        $items = DB::table('csinfo as c')
        ->join('csdetails as cd', 'c.id', '=', 'cd.csid')
        ->join('category as c2', 'c.categoryid', '=', 'c2.id')
        ->join('subcategory as s', 'c.subcategoryid', '=', 's.id')
        ->join('division as d', 'c.divisionid', '=', 'd.divisionid')
        ->join('users as u', 'c.csby', '=', 'u.id')
        ->join('vendor as v', 'cd.vendorid', '=', 'v.id')
        ->join('statuses as s2', 'c.status', '=', 's2.id')
        ->where('c.id', $id)
        ->select(
            'c.id',
            'u.user_name',
            'u.name',
            'c.csdate',
            's2.status',
            'd.divisionname',
            'c.projectno',
            'c.reqpurpose',
            'c2.categoryname',
            's.subcategoryname',
            'v.vendorname',
            'cd.techspecification',
            'cd.unitprice',
            'cd.quantity',
            'cd.totalprice',
            'c.reqpurpose',
            'cd.filename',
            'cd.filepath',
            'cd.documenttype',
            'cd.documentid',
            'cd.uploadby'
        )
        ->get();


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
        return view('cs.report', compact('items', 'approvalFlows'));

    }


    //----
}
