<?php

namespace App\Http\Controllers\Admin;

use App\Models\Annonces;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class AnnonceAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $annonces = Annonces::orderBy('updated_at', 'DESC')->paginate(5);

        return view('admin.annonce.index', compact('annonces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $annonce = Annonces::All();

        $categories = Categories::orderBy('nom', 'asc')->get();

        return view('admin.annonce.ajouter', compact(
            'annonce',
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);

        // création d'une instance de class (model Annonces) pour enregistrer en base .
        $newAnnonce = new Annonces;

        $newAnnonce->category_id = $request->category;

        $newAnnonce->user_id =  Auth::user()->id;

        $newAnnonce->nom = $request->nom;
        $newAnnonce->description = $request->description;
        $newAnnonce->prix = $request->prix;

        // Traitement de l'upload de 'image
        if ($request->file()) {
            $fileName = $request->image->store('public/images/annonces');
            $newAnnonce->image = $fileName;
        }
        // Enregistrement des données
        $newAnnonce->save();

        return Redirect::route('admin.annonce.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $editAnnonce = Annonces::findOrFail($id);

        $categories = Categories::orderBy('nom', 'asc')->get();

        return view('admin.annonce.ajouter', compact(
            'editAnnonce',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $editAnnonce = Annonces::findOrFail($id);

        $editAnnonce->category_id = $request->category;

        $editAnnonce->user_id = Auth::user()->id;

        $editAnnonce->nom = $request->nom;
        $editAnnonce->description = $request->description;
        $editAnnonce->prix = $request->prix;

        // Traitement de l'upload de 'image
        if ($request->file()) {

            if ($editAnnonce->image != '') {
                Storage::delete($editAnnonce->image);
            }

            $fileName = $request->image->store('public/images/annonces');
            $editAnnonce->image = $fileName;
        }

        $editAnnonce->save();
        return Redirect::route('admin.annonce.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        $deleteAnnonce = Annonces::findOrFail($id);

        $deleteAnnonce->delete();

        return redirect(route('admin.annonce.index'));
    }
}
