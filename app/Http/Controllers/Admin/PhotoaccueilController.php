<?php

namespace App\Http\Controllers\Admin;

use App\Photoaccueil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Validator, Redirect, Response, File;
use RealRashid\SweetAlert\Facades\Alert;

class PhotoaccueilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photoaccueils = Photoaccueil::latest()->paginate(6);
        return view('admin.photoaccueils.index')->with('photoaccueils', $photoaccueils);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photoaccueils.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photoaccueil = new Photoaccueil();
        $photoaccueil = $this->storeImage($request, $photoaccueil);

        $photoaccueil->titre = $request->titre;
        $photoaccueil->enligne = $request->enligne;

        $photoaccueil->save();
        Alert::success('Ajout réussi', 'Photo d\'accueil ajoutée');
        return redirect()->route('admin.photoaccueils.index');
    }
    private function storeImage(Request $request, Photoaccueil $photoaccueil)
    {
        $request->validate([
            'titre' => 'required',
            'enligne' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('profile_image')) {
            $destinationPath = public_path(('/profile_images'));
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $insert['image'] = "$profileImage";
            // Save In Database
            $photoaccueil->filename = "$profileImage";
        }
        return $photoaccueil;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Photoaccueil  $photoaccueil
     * @return \Illuminate\Http\Response
     */
    public function show(Photoaccueil $photoaccueil)
    {
        return response()->json($photoaccueil);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photoaccueil  $photoaccueil
     * @return \Illuminate\Http\Response
     */
    public function edit(Photoaccueil $photoaccueil)
    {
        if (Gate::denies('edit-users')) {
            return redirect()->route('admin.photoaccueils.index');
        }
        return view('admin.photoaccueils.edit', [
            'photoaccueil' => $photoaccueil
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photoaccueil  $photoaccueil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photoaccueil $photoaccueil)
    {
        $photoaccueil = $this->storeImage($request, $photoaccueil);

        $photoaccueil->titre = $request->titre;
        $photoaccueil->enligne = $request->enligne;

        $photoaccueil->update();
        Alert::warning('Modification réussi', 'Photo d\'accueil modifiée');
        return redirect()->route('admin.photoaccueils.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photoaccueil  $photoaccueil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Photoaccueil $photoaccueil)
    {
        if (Gate::denies('delete-users')) {
            return redirect()->route('admin.photoaccueils.index');
        }
        $photoaccueil->delete();
        Alert::info('Suppression réussi', 'Photo d\'accueil supprimée');
        return redirect()->route('admin.photoaccueils.index');
    }
}
