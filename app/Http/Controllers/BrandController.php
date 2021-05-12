<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy ('name', 'asc')->get ();

        return view ('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('brands.create');
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
            'brand_name' => ['required', 'string', 'min:3', 'unique:brands,name'],
        ], [
            'brand_name.unique' => 'Ce nom de marque est déjà pris !'
        ]);

        Brand::create ([
            'name' => request()->brand_name
        ]);

        set_message_flash ('Marque créée avec succès !');

        return redirect()->route ('brands.index');
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
        $brand = Brand::findOrFail ($id);

        return view ('brands.edit', compact('brand'));
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
            'brand_name' => ['required', 'string', 'min:3', 'unique:brands,name,'.$id]
        ], [
            'brand_name.unique' => 'Ce nom de marque est déjà pris !'
        ]);

        $brand = Brand::findOrFail ($id);

        // S'il n'y a aucune erreur, je mets a jour
        $brand->update ([
            'name' => request('brand_name')
        ]);

        set_message_flash('Marque mise à jour avec succès !');

        return redirect()->route ('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail ($id);

        if ($brand->products->count () > 0) {

            set_message_flash('Cette marque ne peut pas être supprimée car il y a encore au moins un produit qui l\'utilise !', 'danger');

            return redirect()->route ('brands.index');
        }

        Brand::destroy($id);

        set_message_flash('Marque supprimée avec succès !');

        return redirect()->route ('brands.index');
    }
}
