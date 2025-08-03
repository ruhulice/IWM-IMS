<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentFile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DocType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $results = DB::select('select dt.id, dt.name, count(d) as nod from doc_types dt left join documents d on dt.id = d.doc_type where d.is_active=1 group by dt.id, dt.name order by dt.id');
        return view('documents.dashboard',compact('results'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Document::with(['documentfile' => function($file){
            $file->where('is_active',1);
        }])->where('is_active',1)->orderBy('id', 'desc')->get();
        return view('documents.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_doctype = DocType::all()->sortBy("name");

        $userName = Auth::user()->name;
        $path = 'assets/uploads/documents/'.$userName.'/';
        $res = $this->dir_to_array($path,1);
      
        $res = json_encode($res);
        $rootJson = '[{"id":"node_0","type" : "root","selected":true,"text":"'.$userName.'","children":'.$res.'}]';
        //$rootJson = json_encode($rootJson);
        //var_dump($rootJson);
        return view('documents.create', compact('all_doctype','rootJson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userName = Auth::user()->name;
        //$path = 'assets/uploads/documents/'.$userName.'/';
        $path ='';
        $dirctory = $request->path;
        if(strlen($dirctory)>4){
            $path = 'assets/uploads/documents/'.$dirctory.'/';
        }
        else{
            $path = 'assets/uploads/documents/'.$userName.'/';
        }
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        DB::transaction(function () use ($request,$path) {
            $request->request->add(['created_by' => Auth::id()]);
            $request->request->add(['updated_by' => Auth::id()]);
            $data = Document::create(array_merge($request->all(),["doc_link" => '']));

            if(!empty($request->hasfile('doc_link')))
            {
                $files = $request->file('doc_link');
                foreach($files as $file){
                    $name   = $file->getClientOriginalName();
                    $file->move($path, Carbon::now()->format('Y_m_d_H_s_').$name);
                    $file_name = $path.Carbon::now()->format('Y_m_d_H_s_').$name; 
                    $docFile = new DocumentFile();
                    $docFile->file_name =  $name;
                    $docFile->document_id = $data->id;
                    $docFile->doc_link = $file_name;
                    $docFile->created_by = Auth::id();
                    DocumentFile::create($docFile->toArray());
                }
            }
        });
        return redirect()->route('documents.index')->with(['message' => 'Document saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    //public function show(Document $document)
    public function show($id)
    {
        $document = Document::findOrFail($id);

        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    //public function edit(Document $document)
    public function edit($id)
    {
        $all_doctype = DocType::all();
        $document = Document::with(['documentfile'=>function($file){
            $file->where('is_active',1);
        }])->findOrFail($id);

        $userName = Auth::user()->name;
        $path = 'assets/uploads/documents/'.$userName.'/';
        $res = $this->dir_to_array($path,1);
      
        $res = json_encode($res);
        $rootJson = '[{"id":"node_0","type" : "root","selected":true,"text":"'.$userName.'","children":'.$res.'}]';
        
        return view('documents.edit', compact('document', 'all_doctype','rootJson'));
    }

    // public function delete($id)
    // {
    //     $document = Document::findOrFail($id);

    //     $document->update([
    //         'is_active' => 0,
    //     ]);

    //     return back()->with(['message' => 'Document deleted successfully!']);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Document $document)
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        $userName = Auth::user()->name;
        $path ='';
        $dirctory = $request->path;
        if(strlen($dirctory)>4){
            $path = 'assets/uploads/documents/'.$dirctory.'/';
        }
        else{
            $path = 'assets/uploads/documents/'.$userName.'/';
        }
        // $path = 'assets/uploads/documents/'.$userName.'/';
        // if (!file_exists($path)) {
        //     mkdir($path, 0777, true);
        // }
        $document->update([
            'title' => $request->title,
            'doc_type'      => $request->doc_type,
            'description'     => $request->description,
            'ref'      => $request->ref,
            'client' => $request->client,
            'date'    => $request->date,
            'subject'    => $request->subject,
            'from'    => $request->from,
            'to_whome'    => $request->to_whome,
            'remarks'    => $request->remarks,
            'updated_by' => Auth::id()
        ]);

        if(!empty($request->hasfile('doc_link')))
        {
            $files = $request->file('doc_link');
            foreach($files as $file){
                $name   = $file->getClientOriginalName();
                $file->move($path, Carbon::now()->format('Y_m_d_H_s_').$name);
                $file_name = $path.Carbon::now()->format('Y_m_d_H_s_').$name; 
                $docFile = new DocumentFile();
                $docFile->file_name =  $name;
                $docFile->document_id = $document->id;
                $docFile->doc_link = $file_name;
                $docFile->created_by = Auth::id();
                DocumentFile::create($docFile->toArray());
            }
        }
        // if(!empty($request->hasfile('doc_link')))
        // {
        //     $prev_file = $document->doc_link;
        //     $files = $request->file('doc_link');
        //     $name   = $files->getClientOriginalName();
        //     // $files->move($path, Carbon::now()->format('Y_m_d_H_s_').$name);
        //     // $file_name = $path.Carbon::now()->format('Y_m_d_H_s_').$name; 
        //     $files->move($path, Carbon::now()->format('Y_m_d_H_s_').$name);
        //     $file_name = $path.Carbon::now()->format('Y_m_d_H_s_').$name; 
        //     $document->update([
        //         'doc_link' => $file_name
        //     ]);
        //     if(file_exists($prev_file)){
        //         unlink($prev_file);
        //     }
           
        // }
        return redirect()->route('documents.index')->with('message', 'Document updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Document $document)
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->update([
            'is_active' => 0
        ]);
        //$document->delete();
        return back()->with(['message' => 'Document deleted successfully!']);
    }

      
    function dir_to_array($dir,$id)
    {
            if (!is_dir($dir)) {
                    return null;
            }

            $data = [];

            foreach (new \DirectoryIterator($dir) as $f) {                
                    if ($f->isDot()) {
                            continue;
                    }

                    $path = $f->getPathname();
                    $name = $f->getFilename();

                    if ($f->isFile()) {
                            //$data[] = [ 'children' => $name ];
                    } else {
                            // Process the content of the directory.
                            $files = $this->dir_to_array($path,$id.'1');

                            $data[] = [ 'children'  => $files,
                                        'text' => $name,
                                        'id' => 'node_'.$id
                                     ];
                        
                    }
                    $id++;
            }


            return $data;
    } 

}


    
