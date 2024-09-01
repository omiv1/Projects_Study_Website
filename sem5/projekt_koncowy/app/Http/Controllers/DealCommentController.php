<?php

namespace App\Http\Controllers;

use App\Models\DealComment;
use Illuminate\Http\Request;

class DealCommentController extends Controller
{
    public function index()
    {
        $comments = DealComment::orderby('added_at', 'asc')->get();
        return view('comments', ['comments' => $comments]);
    }

    public function create()
    {
        $comment = new DealComment;
        return view('commentsForm', ['comment' => $comment]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:10|max:255',
        ]);

        if (\Auth::user() == null){
            return view('home');
        }

        $comment = new DealComment;
        $comment->user_id = \Auth::user()->id;
        $comment->deal_id = $request->deal_id;
        $comment->content = $request->content;
        $comment->added_at = now();

        if ($comment->save()) {
            return redirect('comments');
        }

        return view('comments');
    }

    public function edit($id) {
        $comment = DealComment::find($id);

        if (\Auth::user()->id != $comment->user_id) {
            return back()->with(['success' => false, 'message_type' => 'danger',
                'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }

        return view('commentsEditForm', ['comment'=>$comment]);
    }

    public function update(Request $request, $id)
    {
        $comment = DealComment::find($id);

        if(\Auth::user()->id != $comment->user_id)
        {
            return back()->with(['success' => false, 'message_type' => 'danger',
                'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }

        $comment->content = $request->content;
        $comment->edited = true;

        if($comment->save()) {
            return redirect()->route('comments');
        }

        return "Wystąpił błąd.";
    }

    public function destroy($id)
    {
        $comment = DealComment::find($id);

        if(\Auth::user()->id != $comment->user_id)
        {
            return back();
        }

        if($comment->delete()){
            return redirect()->route('comments');
        }
        else return back();
    }
}
