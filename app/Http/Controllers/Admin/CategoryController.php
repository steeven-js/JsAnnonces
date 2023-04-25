<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Categories::orderBy('updated_at', 'DESC')->paginate(5);

        return view('admin.category.index', compact(
            'categories',
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
        $request->validate(['category_name' => 'required|min:5']);

        $categoriesModel = new Categories;
        $categoriesModel->nom = $request->category_name;
        $categoriesModel->save();

        return redirect()->route('admin.category.index');
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
    public function edit(Request $request, string $id)
    {
        $category = Categories::findOrFail($id); // Récupère la catégorie correspondant à l'ID

        $category->nom = $request->category_edit; // Met à jour le nom de la catégorie avec la valeur soumise dans le formulaire

        $category->save(); // Sauvegarde les changements dans la base de données

        return redirect()->route('admin.category.index')->with('success', 'La catégorie a été mise à jour avec succès.'); // Redirige vers la liste des catégories avec un message de succès
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
        $category = Categories::findOrFail($id); // Récupère la catégorie correspondant à l'ID
        $category->delete(); // Supprime la catégorie de la base de données

        return redirect()->route('admin.category.index')->with('success', 'La catégorie a été supprimée avec succès.'); // Redirige vers la liste des catégories avec un message de succès
    }

}
