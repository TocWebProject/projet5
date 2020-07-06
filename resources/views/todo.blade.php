@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo</div>

                <div class="card-body">
                <ul class="list-group">
                    @foreach ($tasks as $task)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-self-center">
                            <a href="#" class="align-self-center">{{ $task->name }}</a>
                            <div class="d-flex justify-content-arround">
                                <button type="button" class="btn btn-primary">
                                    Modifier
                                </button>
                                <button type="button" class="btn btn-secondary ml-1">Supprimer</button>                        
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
