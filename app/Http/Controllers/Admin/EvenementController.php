<?php

namespace App\Http\Controllers\Admin;

use App\Evenement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Validator, Redirect, Response, File;
use RealRashid\SweetAlert\Facades\Alert;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evenements = Evenement::latest()->paginate(6);
        return view('admin.evenements.index')->with('evenements', $evenements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.evenements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evenement = new Evenement();
        $evenement = $this->storeImage($request, $evenement);
        $evenement->titre = $request->titre;
        $evenement->contenu = $request->contenu;
        $evenement->enligne = $request->enligne;

        $evenement->save();
        Alert::success('Ajout réussi', 'Evénement ajouté');
        return redirect()->route('admin.evenements.index');
    }
    private function storeImage(Request $request, Evenement $evenement)
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
            $evenement->filename = "$profileImage";
        }
        return $evenement;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function show(Evenement $evenement)
    {
        return response()->json($evenement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function edit(Evenement $evenement)
    {
        if (Gate::denies('edit-users')) {
            return redirect()->route('admin.evenements.index');
        }
        return view('admin.evenements.edit', [
            'evenement' => $evenement
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evenement $evenement)
    {
        $evenement = $this->storeImage($request, $evenement);

        $evenement->titre = $request->titre;
        $evenement->contenu = $request->contenu;
        $evenement->enligne = $request->enligne;

        $evenement->update();
        Alert::warning('Modification réussi', 'Evénement modifié');
        return redirect()->route('admin.evenements.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Evenement $evenement)
    {
        if (Gate::denies('delete-users')) {
            return redirect()->route('admin.evenements.index');
        }
        $evenement->delete();
        Alert::info('Suppression réussi', 'Evénement supprimé');
        return redirect()->route('admin.evenements.index');
    }
}
