<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CentralICTBudget;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ICTBudgetController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //dd("ICT Budget");

        $users = User::all();
        $centralbudget = CentralICTBudget::all();

        // dd($users);
        return view('ictbudgets.index', compact('users', 'centralbudget'));
    }
    public function create()
    {

        $users = User::all();
        $category = Category::whereIn('categoryid', ['CM','CP','CS','CE','CA'])->get();
        $vendor =  Vendor::where('vtype', 'IT') ->orderBy('vendorname', 'asc')->get();

        return View("ictbudgets.create", compact("users", "category", "vendor"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'categoryid' => 'required|array',
            'subcategoryid' => 'required|array',
            'particulars' => 'required|array',
            'unitprice' => 'required|array',
            'quantity' => 'required|array',
            'subtotalprice' => 'required|array',
            'fy' => 'required|string',
            'bdate' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->particulars as $index => $particular) {
                    CentralICTBudget::create([
                        'categoryid'    => $request->categoryid[$index],
                        'subcategoryid' => $request->subcategoryid[$index],
                        'particulars'   => $particular,
                        'unitprice'     => $request->unitprice[$index],
                        'quantity'      => $request->quantity[$index],
                        'subtotalprice' => $request->subtotalprice[$index],
                        'expenditure'   => $request->expenditure[$index] ?? 0,
                        'fy'            => $request->fy,
                        'bdate'         => $request->bdate,
                        'unit' => "Pcs"
                    ]);
                }
            });

            return redirect()->route('admin.ictbudgets.index')
                             ->with('success', 'ICT Budget created successfully.');

        } catch (\Exception $e) {
            return back()->with("error", "Failed to save: " . $e->getMessage());
        }
    }

    // public function store(Request $request)
    // {
    //     //dd($request);
    //     $request->validate([
    //     'categoryid' => 'required|array',
    //     'subcategoryid' => 'required|array',
    //     'particulars' => 'required|array',
    //     'unitprice' => 'required|array',
    //     'quantity' => 'required|array',
    //     'subtotalprice' => 'required|array',
    //     'bdate' => 'required|date',
    //     'fy' => 'required|string',
    // ]);
    //     dd($request);

    //     try {
    //         DB::transaction(function () use ($request) {

    //             foreach ($request->particulars as $index => $formdata) {
    //                 $ictbudget = CentralICTBudget::create([
    //                 'categoryid' => $request->categoryid[$index],
    //                 'subcategoryid' => $request->subcategoryid[$index],
    //                 'particulars' => $request->particulars[$index],
    //                 'unitprice' => $request->unitprice[$index],
    //                 'quantity' => $request->quantity[$index],
    //                 'subtotalprice' => $request->subtotalprice[$index],
    //                 'fy' => $request->fy,
    //                 'bdate' => $request->bdate
    //                 ]);

    //             }

    //         });
    //         return redirect()->route('admin.ictbudgets.index')
    //                        ->with('success', 'ICT Budget created successfully.');
    //     } catch (\Exception $e) {
    //         return back()->with("error", "fail to save", $e->getMessage());
    //     }
    // }
    //--end
}
