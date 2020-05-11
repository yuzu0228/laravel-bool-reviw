<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request, $id)
    {
    	$validateData = $request->validate([
            'description' => 'required',
        ]);
        
        $post = $request->all();
        
        $data = [
                'user_id' => \Auth::id(),
                'review_id' => $id,
                'description' => $post['description'],
            ];
            
        Comment::insert($data);
        
        return back()->with('flash_message', 'コメントの投稿が完了しました。');
    }
    
    public function delete($id)
    {
        Comment::where('id', $id)->delete();
        return back()->with('flash_message', 'コメントを削除しました。');
    }
}
