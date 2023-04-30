<?php

namespace App\Http\Controllers;

use App\Models\Annonces;
use App\Models\Favoris;
use Illuminate\Http\Request;

class FavorisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Voir tous les favoris
    
        $userId = auth()->id();
        $favoris = Favoris::where('user_id', $userId)->get();
    
        $annonces = [];
    
        foreach ($favoris as $favori) {
            $annonceId = $favori->annonce_id;
            $annonce = Annonces::findOrFail($annonceId);
            $annonces[] = $annonce;
        }

        // dd($annonces);
            
        return view('account.favoris.index', compact('annonces'));
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
        $annonce_id = $request->input('annonce_id');
        $user_id = auth()->id();
    
        $favoris = new Favoris;
        $favoris->annonce_id = $annonce_id;
        $favoris->user_id = $user_id;

        dd($favoris);
        // $favoris->save();
    
        return redirect()->route('home');
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
    public function delete(string $id)
    {
        $favori = Favoris::find($id);
    
        if ($favori) {
            $favori->delete();
            return redirect()->back()->with('success', 'Favori supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Favori non trouvé.');
        }
    }
}
