@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary h3 text-white font-weight-bold text-center">Modifier une vidéo
            </div>
            <div class="card-body">
                <form action="{{ route('admin.videos.update', $video) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @include('admin.videos.form')

                    <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection