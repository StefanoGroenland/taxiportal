<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;


class CommentController extends Controller
{
    public function showComment(){
		return View::make('/opmerkingen');
	}
}
