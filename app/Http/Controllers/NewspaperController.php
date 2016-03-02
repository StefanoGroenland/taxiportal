<?php

namespace App\Http\Controllers;

use App\Newspaper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Route, View;

class NewspaperController extends Controller
{

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Grabs all newspapers from the database and passes them along when making the view.
     */
    public function showNews(){
        $news   = Newspaper::all();
        return View::make('/nieuws', compact('news'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the 'nieuwstoevoegen' view.
     */
    public function showNewsAdd(){
        return View::make('/nieuwstoevoegen');
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Grabs the route parameter ID, Looks for a news row with that ID and passes them along,
     * when making the 'nieuwswijzigen view'
     */
    public function showNewsEdit(){
        $id     = Route::current()->getParameter('id');
        $news   = Newspaper::where('id',$id)->first();
        return View::make('/nieuwswijzigen', compact('news','id'));
    }

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     *
     * Gets values from the $request, validates the input on specific rules.
     * If all passes it will Create a row for a news group with with the rss feed link and a name.
     */
    public function addNews(Request $request){
        $data = array(
            'name'  =>  $request['name'],
            'link'  =>  $request['link']
        );
        $rules = array(
            'name'  =>  'required|max:50',
            'link'  =>  'required'
        );

        $valid = Validator::make($data,$rules);
        if($valid->fails()){
            return redirect()->route('nieuws')->withErrors($valid)->withInput($data);
        }
        $news = Newspaper::create($data);

        $request->session()->flash('alert-success', 'Nieuwsgroep '.$news->name.' is toegevoegd.');
        return redirect()->route('nieuws');
    }

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Gets the ID of the route parameter, and grabs all information for a news row with that ID,
     * aswell as getting data from the $request and changes the linked row with the values of the requests after validation.
     */
    public function editNews(Request $request){
        $id = Route::current()->getParameter('id');

        $news = Newspaper::where('id',$id)->first();
        $data = array(
            'name'  =>  $request['name'],
            'link'  =>  $request['link']
        );
        $rules = array(
            'name'  =>  'required|max:50',
            'link'  =>  'required'
        );
        $valid = Validator::make($data,$rules);
        if($valid->fails()){
            return redirect('nieuwswijzigen/'.$id)->withErrors($valid)->withInput($data);
        }
        $news->update($data);
        $request->session()->flash('alert-success', 'Nieuwsgroep '. $request['name'] .' is gewijziged.');
        return redirect('/nieuws');
    }

    /**
     * @author Stefano Groenland
     * @return \Illuminate\Http\RedirectResponse
     *
     * Grabs the ID of the route, And deletes the corresponding row from the Database.
     */
    public function deleteNews(){
        $id = Route::current()->getParameter('id');

        $news = Newspaper::where('id',$id)->first();
        $news->delete();
        session()->flash('alert-success', 'Nieuwsgroep '.$news->name .' verwijderd.');
        return redirect()->route('nieuws');
    }
}
