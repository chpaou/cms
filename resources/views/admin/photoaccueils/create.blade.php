@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white font-weight-bold text-center h3">Ajouter une photo d'accueil
            </div>
            <div class="card-body">
                <form action="{{ route('admin.photoaccueils.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('admin.photoaccueils.form')

                    <button type="submit" class="btn btn-success btn-block">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection