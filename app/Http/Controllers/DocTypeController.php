<?php

namespace App\Http\Controllers;

use App\Models\DocType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input('docType');
        $exist = DocType::where('name', '=', trim($input))->exists();
        if (!$exist){
            $docType = new DocType();
            $docType->name = $request->docType;
            $docType->crated_by = Auth::id();
            DocType::create($docType->toArray());
            $response = array(
                'status' => 'success',
                'msg' => 'Document type saved successfully',
                'exist'=>$exist
            );
            return response()->json($response); 
        }
        else{
            $response = array(
                'status' => 'false',
                'msg' => 'Document type already exist!',
                'exist'=>$exist
            );
            return response()->json($response); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocType  $docType
     * @return \Illuminate\Http\Response
     */
    public function show(DocType $docType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocType  $docType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocType $docType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocType  $docType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocType $docType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocType  $docType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocType $docType)
    {
        //
    }
}
