@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="card">
                <div class="card-header">Tâches</div>
                <div class="card-body align-middle text-center mt-3 mb-3">   
                    Courage {{ Auth::user()->name }} ! Vous avez {{ $numberOfTasks }} tâches à effectuer !
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-between">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    Citation du Jour
                </div>
                <div class="card-body quote-body text-center">
                <div id="QuoteOFDay" class="mt-5"></div>
                </div>
            </div>
        </div>
        <openweathermap-api></openweathermap-api>
    </div>
    <unsplash-api></unsplash-api>
</div>
@endsection
