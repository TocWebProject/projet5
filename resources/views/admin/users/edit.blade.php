@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier: <span class="font-weight-bold font-italic">{{ $user->name }}</span></div>

                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf 
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label">{{ __('Nom') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" required autocomplete="email" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="is_admin" 
                            @if ($user->is_admin == 1)) checked @endif >
                            <label for="{{ $user->is_admin }}" class="form-check-label">Administrateur</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier les informations</button>
                        <a href="{{ route('admin.users.index') }}"><button class="btn btn-secondary mr-1">Retour</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection