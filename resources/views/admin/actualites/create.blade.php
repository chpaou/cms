@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-success text-white font-weight-bold text-center h3">Ajouter une actualité
            </div>
            <div class="card-body">
                <form action="{{ route('admin.actualites.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('admin.actualites.form')

                    <button type="submit" class="btn btn-success btn-block">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection