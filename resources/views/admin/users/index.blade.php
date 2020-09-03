@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Liste des utilisateurs
                    <a href="{{ route('admin.users.create') }}"><button class="btn-sm btn-primary mr-1"><i class="fas fa-user-plus mr-1"></i>Créer un Utilisateur</button></a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>   
                            @foreach ($users as $user)
                                <tr>    
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if ($user->is_admin == 1)
                                <td>Administrateur</td>
                                @else
                                <td>Utilisateur</td>
                                @endif
                                <td class="d-flex align-items">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"><button class="btn-sm btn-primary mr-1"><i class="far fa-edit mr-1"></i>Éditer</button></a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-secondary"><i class="far fa-trash-alt mr-1"></i>Supprimer</button>
                                    </form>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection