<?php

namespace App\Http\Controllers;

use App\Models\Favoris;
use App\Models\Annonces;
use Illuminate\Support\Facades\Auth;

class FavorisController extends Controller
{
    // Cette syntaxe est utilisée pour spécifier les conditions de jointure lorsqu'on utilise la méthode join dans Laravel.

    // Voici comment la syntaxe est interprétée :

    // Le premier paramètre (favoris) est le nom de la table avec laquelle on veut effectuer la jointure.
    // Le deuxième paramètre (annonces.id) spécifie la colonne de la première table (annonces) à utiliser pour la jointure.
    // Le troisième paramètre (=) spécifie le type de jointure à effectuer, dans ce cas une jointure équijointe (également appelée jointure interne) qui ne renverra que les enregistrements où les valeurs dans les colonnes de jointure sont identiques.
    // Le quatrième paramètre (favoris.annonce_id) spécifie la colonne de la deuxième table (favoris) à utiliser pour la jointure.
    // Ainsi, la syntaxe 'annonces.id', '=', 'favoris.annonce_id' indique que nous voulons joindre les enregistrements des tables annonces et favoris où les valeurs de la colonne id de annonces et la colonne annonce_id de favoris sont identiques.

    public function index()
    {
        //Obtenir l'ID de l'utilisateur connecté
        $userId = Auth::user()->id;

        //Obtenir les annonces correspondant aux éléments favoris de l'utilisateur connecté en utilisant une requête SQL JOIN
        $favoris = Annonces::join('favoris', 'annonces.id', '=', 'favoris.annonce_id') //Jointure entre la table "annonces" et la table "favoris" en utilisant les colonnes "id" et "annonce_id"
            ->where('favoris.user_id', $userId) //Filtrer les résultats par l'ID de l'utilisateur connecté
            ->get(); //Exécuter la requête SQL et récupérer les résultats

        //Envoyer les favoris à la vue
        return view('account.favoris.index', compact('favoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add($id = 0)
    {

        // Vérifier si l'élément avec l'ID donné est déjà dans les favoris de l'utilisateur actuellement connecté
        $isFavoris = Favoris::where('annonce_id', $id)->where('user_id', Auth::user()->id)->first();

        // Si l'élément n'est pas dans les favoris, l'ajouter
        if (empty($isFavoris)) {
            $addFavoris = new Favoris;

            $addFavoris->annonce_id = $id;
            $addFavoris->user_id = Auth::user()->id;

            $addFavoris->save();
        }
        // Si l'élément est déjà dans les favoris, le supprimer
        else {

            Favoris::where('annonce_id', $id)->where('user_id', Auth::user()->id)->delete();

        }

        // Rediriger l'utilisateur vers la page précédente
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {

        $deleteFavoris = Favoris::findOrFail($id);

        // dd($deleteFavoris);

        $deleteFavoris->delete();

        return redirect()->route('account.favoris.list');
    }
}
