<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use Route, View;


class CommentController extends Controller
{
    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Gets 2 objects from the databases and passes them along with the view when making the view.
     */
    public function showComment(){
        $comments = Comment::with('driver')->where('approved','!=',1)->get();
        $commentsApproved = Comment::with('driver')->where('approved','=',1)->get();

		return View::make('/opmerkingen', compact('comments','commentsApproved'));
	}

    /**
     * @author Richard Perdaan
     * @return mixed
     *  TODO : fill in func description
     */
    public function showCommentEdit(){
		return View::make('/opmerkingwijzigen');
	}
}