<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy ('name', 'asc')->get ();

        return view ('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request ()->validate ([
            'category_name' => ['required', 'string', 'min:3', 'unique:categories,name'],
        ], [
            'category_name.unique' => 'Ce nom de catégorie est déjà pris !'
        ]);

        Category::create ([
            'name' => request()->category_name
        ]);

        set_message_flash ('Catégorie créée avec succès !');

        return redirect()->route ('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort (404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail ($id);

        return view ('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'category_name' => ['required', 'string', 'min:3', 'unique:categories,name,'.$id]
        ], [
            'category_name.unique' => 'Ce nom de catégorie est déjà pris !'
        ]);

        $category = Category::findOrFail ($id);

        // S'il n'y a aucune erreur, je mets a jour
        $category->update ([
            'name' => request('category_name')
        ]);

        set_message_flash('Catégorie mise à jour avec succès !');

        return redirect()->route ('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail ($id);

        if ($category->products->count () > 0) {

            set_message_flash('Cette catégorie ne peut pas être supprimée car il y a encore au moins un produit qui l\'utilise !', 'danger');

            return redirect()->route ('categories.index');
        }

        Category::destroy($id);

        set_message_flash('Catégorie supprimée avec succès !');

        return redirect()->route ('categories.index');
    }
}
