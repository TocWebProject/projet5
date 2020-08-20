@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tâches</div>
                <div class="card-body align-middle text-center">   
                    Courage ! Vous avez {{ $numberOfTasks }} tâches à effectuer !
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-between">
        <news-api></news-api>
        <openweathermap-api></openweathermap-api>
    </div>
    <unsplash-api></unsplash-api>
</div>
@endsection
