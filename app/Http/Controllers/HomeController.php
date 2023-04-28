<?php

namespace App\Http\Controllers;

use App\Models\Annonces;
use App\Models\Categories;
use Illuminate\Http\Request;

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

        return view('home', Compact(
            'categories',
            'annonces',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        }else {
          //  dd($id) ;
            $annonces = Annonces::where('category_id', $id)->orderBy('updated_at', 'DESC')->paginate(5);
        }

        return view('home', Compact(
            'annonces',
            'categories',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
