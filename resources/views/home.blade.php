@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are normal user - You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-between">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Tâches</div>
                <div class="card-body align-middle text-center"> Vous avez 34 000 Tâches à effectuer</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Les Nouvelles du monde</div>
                <div class="card-body align-middle text-center"> Notre maison brûle</div>
            </div>
        </div>
        <openweathermap-api></openweathermap-api>
    </div>
    <unsplash-api></unsplash-api>
</div>
@endsection
