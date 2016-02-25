<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use Route, View;
use App\Driver;
use App\Taxi;

class CommentController extends Controller
{
    public function showComment(){
        $comments = Comment::with('driver')->get();
		return View::make('/opmerkingen', compact('comments'));
	}
	public function showCommentEdit(){
		return View::make('/opmerkingwijzigen');
	}
}