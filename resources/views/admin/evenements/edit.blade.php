@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary h3 text-white font-weight-bold text-center">Modifier une événement
            </div>
            <div class="card-body">
                <form action="{{ route('admin.evenements.update', $evenement) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @include('admin.evenements.form')

                    <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection