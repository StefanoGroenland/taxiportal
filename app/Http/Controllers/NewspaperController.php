<?php

namespace App\Http\Controllers;

use App\Newspaper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Route, View;
use Image as Image;
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
            'name'              =>  $request['name'],
            'link'              =>  $request['link']
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
        $this->upload($request,$news->id);

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
        $this->upload($request,$news->id);
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
        if(!$news->logo == ""){
            unlink($news->logo);
        }
        session()->flash('alert-success', 'Nieuwsgroep '.$news->name .' verwijderd.');
        return redirect()->route('nieuws');
    }

    /**
     * @authors Stefano Groenland
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Grabs the file named 'logo' from the request and uploads it onto the server,
     * It updates the corresponding newspaper with the link to the uploaded picture as their logo in the Newspaper table.
     */
    public function upload(Request $request , $id){

        $x = $request['x'];
        $y = $request['y'];
        $h = $request['h'];
        $w = $request['w'];

        $file = array('logo' => $request->file('logo'));
        $rules = array('logo' => 'required|mimes:jpeg,bmp,png,jpg',);
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            if ($file) {
                //$request->session()->flash('alert-danger', 'U heeft geen bestand / geen geldig bestand gekozen om te uploaden, voeg een foto toe.');
            }
            return redirect('/nieuws');
        } else {
            if ($request->file('logo')->isValid()) {
                $destinationPath = 'assets/uploads';
                $extension = $request->file('logo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                $request->file('logo')->move($destinationPath, $fileName);
                $ava = $destinationPath . '/' . $fileName;
                $img = Image::make($ava)->fit(200)->crop($w, $h, $x, $y)->save();
                $final = $destinationPath . '/' . $img->basename;

                Newspaper::uploadPicture($id, $final);
                return redirect('/nieuws');

            } else {
                $request->session()->flash('alert-danger', 'Er is een fout opgetreden tijdens het uploaden van uw bestand.');
            }
        }

    }

}
