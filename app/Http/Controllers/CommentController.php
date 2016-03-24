<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Driver;
use Route, View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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


        $driver = Driver::with('user')->where('user_id',Auth::user()->id)->first();

        if(Auth::user()->user_rank == 'admin'){
            $commentsApproved = Comment::with('driver')->where('approved','=',1)->get();
        }else{
            $commentsApproved = Comment::with('driver')->where('approved','=',1)->where('driver_id',$driver->id)->get();
        }

        foreach($commentsApproved as $comment){
            if($driver){
                $comment->where('driver_id',$driver->id)->update(['seen' => 1]);
            }
        }

		return View::make('/opmerkingen', compact('comments','commentsApproved'));
	}

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Gets all comments where column 'approved' = 1.
     */
    public function showCommentsApproved(){
        $commentsApproved = Comment::with('driver')->where('approved','=',1)->get();
        return View::make('/opmerkingen-verwerkt', compact('comments','commentsApproved'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Grabs the route parameter ID, Looks for a comment row with that ID and passes them along,
     * when making the 'opmerkingwijzigen view'
     */
    public function showCommentEdit(){
        $id = Route::current()->getParameter('id');
        $comment = Comment::with('driver')->where('id',$id)->first();
		return View::make('/opmerkingwijzigen',compact('comment','id'));
	}

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Gets the ID of the route parameter, and grabs all information for a comment row with that ID,
     * aswell as getting data from the $request and changes the linked row with the values of the requests after validation.
     */
    public function editComment(Request $request){
        $id = Route::current()->getParameter('id');
        $comment = Comment::where('id',$id)->first();
        if($comment->approved == 0){
            $redir = 1;
        }else{
            $redir = 0;
        }
        $data = array(
            'comment'   =>  $request['comment'],
            'approved'  =>  $request['approved']
        );
        $rules = array(
            'comment'   =>  'required|max:255'
        );
        $valid = Validator::make($data,$rules);
        if($valid->fails()){
            return redirect('opmerkingwijzigen/'.$id)->withErrors($valid)->withInput($data);
        }
        $comment->update($data);
        $request->session()->flash('alert-success', 'Opmerking '. $request['name'] .' is gewijziged.');

        if($redir == 1){
            return redirect('/opmerkingen');
        }
        return redirect('/opmerkingen/verwerkt');


    }

    /**
     * @author Stefano Groenland
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Looks for a row with the passed ID , upon finding it checks what the 'approved' value is,
     * when it's not approved it will be set to approved, and if it's approved it will be set to not approved.
     */
    public function togglesStateComment(){
        $id     = Route::current()->getParameter('id');
        $redir  = Route::current()->getParameter('redir');
        $msg    = Comment::where('id',$id)->first();
        if(!$msg->approved > 0){
            $msg->where('id',$id)->update(['approved' => 1]);
        }else{
            $msg->where('id',$id)->update(['approved' => 0]);
        }
        session()->flash('alert-success', 'Opmerking status aangepast.');
        if($redir < 1){
            return redirect('/opmerkingen');
        }else{
            return redirect('/opmerkingen/verwerkt');
        }

    }

    /**
     * @author Stefano Groenland
     * @return \Illuminate\Http\RedirectResponse
     *
     * Grabs the ID of the route, And deletes the corresponding row from the Database.
     */
    public function deleteComment(){
        $id = Route::current()->getParameter('id');

        $comment = Comment::where('id',$id)->first();
        $comment->delete();
        session()->flash('alert-success', 'Commentaar verwijderd.');
        return redirect()->route('opmerkingen');
    }

}