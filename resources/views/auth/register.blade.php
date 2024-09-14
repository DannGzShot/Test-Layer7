@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="card col-lg-4 col-md-6 col-sm-8 col-xs-12 position-absolute top-50 start-50 translate-middle">
                <div class="card-header text-center my-3"><h2 class="text-uppercase"> Registro </h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-floating mb-3">
                                <input id="name" type="text" placeholder="" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <label> Nombre </label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-floating mb-3">
                                <input id="email" type="email" placeholder="" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <label> Email </label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-floating mb-3">
                                <input id="password" type="password" placeholder="" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <label> Contraseña </label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-floating mb-3">
                                <input id="password-confirm" type="password" placeholder="" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <label> Confirmar Contraseña </label>
                        </div>

                            @if (Route::has('register'))
                            <button type="submit" class="btn btn-danger mb-3 w-100"> Registrar </button>
                        @endif

                    </form>
                </div>
            </div>
       
    </div>
</div>
@endsection