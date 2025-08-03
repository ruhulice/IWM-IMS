<?php

namespace App\Http\Controllers;

use App\Models\DocumentFile;
use Illuminate\Http\Request;

class DocumentFileController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentFile  $documentFile
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentFile $documentFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentFile  $documentFile
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentFile $documentFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentFile  $documentFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentFile $documentFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentFile  $documentFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentFile $documentFile)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $documentFile = DocumentFile::findOrFail($id);
        $documentFile->update([
            'is_active' => 0
        ]);
        $response = array(
            'status' => 'success',
            'msg' => 'File deleted successfully'
        );
        return response()->json($response); 
      
    }
}
