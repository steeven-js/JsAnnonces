<?php

namespace App\Http\Controllers;

use App\Models\Favoris;
use App\Models\Annonces;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Categories::All();

        $annonces = Annonces::orderBy('updated_at', 'DESC')->paginate(8);

        $userId = Auth::user()->id;
        $favoris = Favoris::where('user_id', $userId)->get();

        return view('home', Compact(
            'categories',
            'annonces',
            'favoris',
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show($id = 0)
    {
        //
        $categories = Categories::All();

        if ($id == 0) {

            $annonces = Annonces::orderBy('updated_at', 'DESC')->get();
        } else {
            //  dd($id) ;
            $annonces = Annonces::where('category_id', $id)->orderBy('updated_at', 'DESC')->paginate(5);
        }

        return view('home', Compact(
            'annonces',
            'categories',
        ));
    }

}
