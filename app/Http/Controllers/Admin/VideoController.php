<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Validator, Redirect, Response, File;
use RealRashid\SweetAlert\Facades\Alert;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::latest()->paginate(6);
        return view('admin.videos.index')->with('videos', $videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'enligne' => 'required',
            'url' => 'required'
        ]);
        Video::create($request->all());
        Alert::success('Ajout réussi', 'Vidéo ajoutée');
        return redirect()->route('admin.videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return response()->json($video);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        if (Gate::denies('edit-users')) {
            return redirect()->route('admin.videos.index');
        }
        return view('admin.videos.edit', [
            'video' => $video
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'enligne' => 'required',
            'url' => 'required'
        ]);

        $video->update($request->all());
        Alert::warning('Modification réussi', 'Vidéo modifiée');
        return redirect()->route('admin.videos.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Video $video)
    {
        if (Gate::denies('delete-users')) {
            return redirect()->route('admin.videos.index');
        }
        $video->delete();
        Alert::info('Suppression réussi', 'Vidéo supprimée');
        return redirect()->route('admin.videos.index');
    }
}
