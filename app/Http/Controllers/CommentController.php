<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Route, View;

class CommentController extends Controller
{
    //test
    public function showComment(){
		return View::make('/opmerkingen');
	}
	public function showCommentEdit(){
		return View::make('/opmerkingwijzigen');
	}
}