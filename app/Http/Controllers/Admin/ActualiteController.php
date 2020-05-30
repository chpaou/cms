<?php

namespace App\Http\Controllers\Admin;

use App\Actualite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Validator, Redirect, Response, File;
use RealRashid\SweetAlert\Facades\Alert;

class ActualiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actualites = Actualite::latest()->paginate(6);
        return view('admin.actualites.index')->with('actualites', $actualites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.actualites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actualite1 = new Actualite();
        $actualite = $this->storeImage($request, $actualite1);
        $actualite->titre = $request->titre;
        $actualite->contenu = $request->contenu;
        $actualite->enligne = $request->enligne;

        $actualite->save();
        Alert::success('Ajout réussi', 'Actualité ajoutée');
        return redirect()->route('admin.actualites.index');
    }

    private function storeImage(Request $request, Actualite $actualite)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'enligne' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('profile_image')) {
            $destinationPath = public_path(('/profile_images'));
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $insert['image'] = "$profileImage";
            // Save In Database
            $actualite->filename = "$profileImage";
        }
        return $actualite;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actualite  $actualite
     * @return \Illuminate\Http\Response
     */
    public function show(Actualite $actualite)
    {
        return response()->json($actualite);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actualite  $actualite
     * @return \Illuminate\Http\Response
     */
    public function edit(Actualite $actualite)
    {
        if (Gate::denies('edit-users')) {
            return redirect()->route('admin.actualites.index');
        }
        return view('admin.actualites.edit', [
            'actualite' => $actualite
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actualite  $actualite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actualite $actualite)
    {
        $actualite = $this->storeImage($request, $actualite);

        $actualite->titre = $request->titre;
        $actualite->contenu = $request->contenu;
        $actualite->enligne = $request->enligne;

        $actualite->update();
        Alert::warning('Modification réussi', 'Actualité modifiée');

        return redirect()->route('admin.actualites.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actualite  $actualite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Actualite $actualite)
    {
        if (Gate::denies('delete-users')) {
            return redirect()->route('admin.actualites.index');
        }
        $actualite->delete();
        Alert::info('Suppression réussi', 'Actualité supprimée');
        return redirect()->route('admin.actualites.index');
    }
}
