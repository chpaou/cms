@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-center text-bold text-white h4">Liste des actualites</div>

            <div class="card-body">
                @can('edit-users')
                <a href="{{ route('admin.actualites.create') }}" class="btn btn-outline-primary mb-2"><i
                        class="fa fa-plus-square"></i></a>
                @endcan
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Date publication</th>
                            <th scope="col">Etat</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actualites as $actualite)
                        <tr>
                            <th scope="row">{{ $actualite->id }}</th>
                            <td>{{ $actualite->titre }}</td>
                            <td>{{ $actualite->created_at }}</td>
                            <td>
                                @if ($actualite->enligne)
                                <span class="badge badge-success">Publier</span>
                                @else
                                <span class="badge badge-danger">Ne pas publier</span>
                                @endif
                            </td>

                            <td class="d-flex justify-content-sm-around align-content-center">
                                @can('edit-users')
                                <a href="{{ route('admin.actualites.edit', ['actualite' => $actualite->id]) }}"
                                    class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('delete-users')
                                <form action="{{ route('admin.actualites.destroy', $actualite->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"><i
                                            class="fa fa-trash-o"></i></button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row d-flex justify-content-center">
                    {{ $actualites->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection