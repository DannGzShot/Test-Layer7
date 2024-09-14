@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="card col-lg-4 col-md-6 col-sm-8 col-xs-12 position-absolute top-50 start-50 translate-middle">
                <div class="card-header text-center my-3"><h2 class="text-uppercase"> Olvidaste tu contraseña? </h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label> Email </label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 w-100"> Enviar enlace para resetar la contraseña </button>

                    </form>
                </div>
            </div>
       
    </div>
</div>
@endsection