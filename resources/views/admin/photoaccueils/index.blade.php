@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-center text-bold text-white h4">Liste des photos d'accueil</div>

            <div class="card-body">
                @can('edit-users')
                <a href="{{ route('admin.photoaccueils.create') }}" class="btn btn-outline-primary mb-2"><i
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
                        @foreach ($photoaccueils as $photoaccueil)
                        <tr>
                            <th scope="row">{{ $photoaccueil->id }}</th>
                            <td>{{ $photoaccueil->titre }}</td>
                            <td>{{ $photoaccueil->created_at }}</td>
                            <td>
                                @if ($photoaccueil->enligne)
                                <span class="badge badge-success">Publier</span>
                                @else
                                <span class="badge badge-danger">Ne pas publier</span>
                                @endif
                            </td>

                            <td class="d-flex justify-content-sm-around align-content-center">
                                @can('edit-users')
                                <a href="{{ route('admin.photoaccueils.edit', ['photoaccueil' => $photoaccueil->id]) }}"
                                    class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('delete-users')
                                <form action="{{ route('admin.photoaccueils.destroy', $photoaccueil->id) }}"
                                    method="POST" class="d-inline">
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
                    {{ $photoaccueils->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection