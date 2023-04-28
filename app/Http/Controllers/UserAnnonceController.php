<?php

namespace App\Http\Controllers;

use App\Models\Annonces;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class UserAnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $userAnnonces = Annonces::where('user_id', $userId)->get();

        return view('account.index', compact('userAnnonces'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $annonce = Annonces::All();

        $categories = Categories::orderBy('nom', 'asc')->get();

        return view('account.annonce.ajouter', compact(
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
        $newUserAnnonce = new Annonces;

        $newUserAnnonce->category_id = $request->category;

        $newUserAnnonce->user_id =  Auth::user()->id;

        $newUserAnnonce->nom = $request->nom;
        $newUserAnnonce->description = $request->description;
        $newUserAnnonce->prix = $request->prix;

        // Traitement de l'upload de 'image
        if ($request->file()) {
            $fileName = $request->image->store('public/images/annonces');
            $newUserAnnonce->image = $fileName;
        }
        // Enregistrement des données
        $newUserAnnonce->save();

        return Redirect::route('account.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Voir une annonce
        $showUserAnnonce = Annonces::findOrFail($id);

        // dd($showUserAnnonce);

        return view('account.annonce.show', compact(
            'showUserAnnonce',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $editUserAnnonce = Annonces::findOrFail($id);

        $categories = Categories::orderBy('nom', 'asc')->get();

        return view('account.annonce.ajouter', compact(
            'editUserAnnonce',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $editUserAnnonce = Annonces::findOrFail($id);

        $editUserAnnonce->category_id = $request->category;

        $editUserAnnonce->user_id = Auth::user()->id;

        $editUserAnnonce->nom = $request->nom;
        $editUserAnnonce->description = $request->description;
        $editUserAnnonce->prix = $request->prix;

        // Traitement de l'upload de 'image
        if ($request->file()) {

            if ($editUserAnnonce->image != '') {
                Storage::delete($editUserAnnonce->image);
            }

            $fileName = $request->image->store('public/images/annonces');
            $editUserAnnonce->image = $fileName;
        }

        $editUserAnnonce->save();
        return Redirect::route('account.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        // Supprimer une annonce
        $deleteAnnonce = Annonces::findOrFail($id);

        $deleteAnnonce->delete();

        return redirect(route('account.annonce.index'));
    }
}
