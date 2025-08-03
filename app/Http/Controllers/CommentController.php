<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Carbon\Carbon;
use DB;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$comments = Comment::orderBy('id', 'desc')->paginate(15);
         $comments = "";

        return view('comment.index')->with(compact('comments'));
    }

    // public function create()
    // {
    //     return view('comment.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'cmnt' => 'required',
    //         'status' => 'required',
    //         'progress' => 'required',
    //     ]);

    //     DB::transaction(function () use ($request) {
    //         $request->request->add(['user_id' => Auth::id()]);
    //         Comment::create($request->all());
    //     });

    //     return Redirect::to('comments')->with('success', 'Comment created successfully.');
    // }

    // public function show(Comment $comment)
    // {
    //     return view('comment.show', $comment);
    // }

    // public function edit(Comment $comment)
    // {
    //     return view('comment.edit', $comment);
    // }

    // public function update(Request $request, Comment $comment)
    // {
    //     $request->validate([
    //         'cmnt' => 'required',
    //     ]);

    //     if (Auth::user()->type == 1) {
    //         $comment->update($request->all());
    //         return Redirect::to('comments')
    //             ->with('success', 'Comment updated successfully');
    //     } elseif ($comment->user_id == Auth::id()) {
    //         $comment->update(['cmnt' => $request->cmnt]);
    //         return Redirect::to('comments')
    //             ->with('success', 'Comment updated successfully');
    //     } else {
    //         return Redirect::to('comments')
    //             ->with('error', "<strong>Failed!!!</strong> You can <strong>Edit</strong> only your's comments");
    //     }
    // }

    // public function destroy(Comment $comment)
    // {
    //     if ($comment->user_id == Auth::id()||Auth::user()->type == 1) {
    //         $comment->delete();
    //         return Redirect::to('comments')->with('success', 'Comment deleted successfully');
    //     } else {
    //         return Redirect::to('comments')
    //             ->with('error', "<strong>Failed!!!</strong> You can <strong>Delete</strong> only your's comments");
    //     }

    // }
}
