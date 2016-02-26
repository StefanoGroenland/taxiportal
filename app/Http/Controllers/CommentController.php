<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use Route, View;


class CommentController extends Controller
{
    public function showComment(){
        $comments = Comment::with('driver')->where('approved','!=',1)->get();
        $commentsApproved = Comment::with('driver')->where('approved','=',1)->get();

		return View::make('/opmerkingen', compact('comments','commentsApproved'));
	}
	public function showCommentEdit(){
		return View::make('/opmerkingwijzigen');
	}
}