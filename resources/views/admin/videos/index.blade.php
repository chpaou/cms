@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-center text-bold text-white h4">Liste des vidéos</div>

            <div class="card-body">
                @can('edit-users')
                <a href="{{ route('admin.videos.create') }}" class="btn btn-outline-primary mb-2"><i
                        class="fa fa-plus-square"></i></a>
                @endcan
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Date publication</th>
                            <th scope="col">URL</th>
                            <th scope="col">Etat</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($videos as $video)
                        <tr>
                            <th scope="row">{{ $video->id }}</th>
                            <td>{{ $video->titre }}</td>
                            <td>{{ $video->created_at }}</td>
                            <td>{{ $video->url }}</td>
                            <td>
                                @if ($video->enligne)
                                <span class="badge badge-success">Publier</span>
                                @else
                                <span class="badge badge-danger">Ne pas publier</span>
                                @endif
                            </td>

                            <td class="d-flex justify-content-sm-around align-content-center">
                                @can('edit-users')
                                <a href="{{ route('admin.videos.edit', ['video' => $video->id]) }}"
                                    class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('delete-users')
                                <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST"
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
                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection