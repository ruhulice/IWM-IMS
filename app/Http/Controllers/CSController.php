<?php

namespace App\Http\Controllers;

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
            ->join('catagory as c3', 'c.categoryid', '=', 'c3.id')
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
            );

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
        $vendor = Vendor::all();

        // $users      = User::select('users.*')->leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')->where('user_roles.role_id', 5)->where('users.is_active', true)->get();

        // return view('transfer.create', compact('subcategory','equipments', 'conditions', 'divisions', 'statues', 'users','divisions'));
        $users = User::all();
        return view('cs.create', compact('users', 'category', 'divisions', 'vendor'));
    }
    // public function store(Request $request)
    // {
    //     //  dd($request);
    //     $userid = Auth::user()->id;
    //     try {
    //         DB::transaction(function () use ($request, $userid) {
    //             // Insert into master (csinfo)
    //             $csinfo = CSInfo::create([
    //                 'csdate'      => $request->csdate,
    //                 'csby'        => $userid,
    //                 'divisionid'  => $request->divisionid,
    //                 'projectno'   => $request->projectno,
    //                 'categoryid'        => $request->categoryid,
    //                 'subcategoryid'     => $request->subcategoryid,
    //                 'status'      => 1,
    //                 'reqpurpose'  => $request->reqpurpose,
    //                 //'created_at'  => now(),
    //             ]);

    //             // Insert into child table (csdetails)
    //             foreach ($request->categoryid as $key => $value) {

    //                 $fileName = null;
    //                 $filePath = null;

    //                 // Validate all files before loop
    //                 $request->validate([
    //                     'pdffile.*' => 'nullable|mimes:pdf|max:20480' // max 20MB per file
    //                 ]);

    //                 // Handle file if exists for this row
    //                 if ($request->hasFile('pdffile') && isset($request->file('pdffile')[$key])) {
    //                     $file = $request->file('pdffile')[$key];

    //                     $fileName = time() . '_' . $file->getClientOriginalName();

    //                     // Store in storage/app/public/csfiles
    //                     $filePath = $file->storeAs('csfiles', $fileName, 'public');
    //                 }


    //                 // dd($fileName);
    //                 // dd($filePath);

    //                 // First insert without documentid
    //                 $csDetail = CSDetails::create([
    //                     'csid'              => $csinfo->id,
    //                     'vendorid'          => $request->vendorid[$key] ?? null,
    //                     'techspecification' => $request->techspecification[$key],
    //                     'unitprice'         => $request->rate[$key],
    //                     'quantity'          => $request->quantity[$key],
    //                     'subtotal'          => $request->quantity[$key] * $request->rate[$key],
    //                     'totalprice'        => $request->price[$key],
    //                     'remarks'           => $request->remarks[$key] ?? null,
    //                     'filename'          => $fileName,
    //                     'filepath'          => $filePath,
    //                     'documenttype'      => 2,
    //                     'uploaddate'        => now(),
    //                     'uploadby'          => auth()->id(),
    //                     //'created_at'        => now(),
    //                 ]);

    //                 // Now update its own documentid
    //                 $csDetail->update([
    //                     'documentid' => $csDetail->id,
    //                 ]);
    //             }
    //         });

    //         return redirect()->route('admin.cs.index')
    //             ->with('success', 'Requisition created successfully.');

    //     } catch (\Exception $e) {
    //         Log::error('Requisition creation failed: ' . $e->getMessage());

    //         return back()->with('error', 'Failed to save requisition: ' . $e->getMessage());
    //     }
    // }

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
                    ]);

                    // Update documentid to its own ID
                    $csDetail->update([
                        'documentid' => $csDetail->id,
                    ]);
                }

            });

            return redirect()->route('admin.cs.index')
                             ->with('success', 'Requisition created successfully.');

        } catch (\Exception $e) {
            Log::error('Requisition creation failed: ' . $e->getMessage());

            return back()->with('error', 'Failed to save requisition: ' . $e->getMessage());
        }
    }


    //----
}
