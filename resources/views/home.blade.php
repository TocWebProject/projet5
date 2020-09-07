@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="card">
                <div class="card-header">Tâches</div>
                <div class="card-body align-middle text-center mt-3 mb-3">   
                    Bonjour {{ Auth::user()->name }}, {{ $sentenceToTransmit}}
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
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="card">
                <div class="card-header">Votre Avatar</div>
                <div class="card-body align-middle text-center p-0 mt-3">
                    <form class="d-flex justify-content-center" action="/avatar" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="avatar">Ajouter/Modifier votre avatar:</label>
                            <input type="file" class="form-control-file ml-3" name="image" id="avatar">
                            <span class="text-danger ml-3"> {{ $errors->first('image') }}</span>
                            <input class="btn btn-outline-primary btn-sm float-left mt-1 ml-3" type="submit" name="upload "value="Enregistrer"/>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>    
    <unsplash-api></unsplash-api>
</div>
@endsection
