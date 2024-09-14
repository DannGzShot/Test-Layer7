@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="card col-lg-4 col-md-6 col-sm-8 col-xs-12 position-absolute top-50 start-50 translate-middle">
                <div class="card-header text-center my-3"><h2 class="text-uppercase">{{ __('Login') }}</h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-floating mb-3">
                                <input id="email" type="email" placeholder="" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label> Email </label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                                @enderror
                                
                              </div>
                              <div class="form-floating mb-3">
                                <input id="password" type="password" placeholder="" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <label> Contraseña </label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                                @enderror
                            </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember"> Recordarme </label>
                                </div>
                                <div class="text-center mb-3">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                           Olvidaste tu contraseña?
                                        </a>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary mb-3 w-100"> Entrar </button>

                                
                                
                           
                            @if (Route::has('register'))
                            <p class="text-end">Crear cuenta <a href="{{ route('register') }}"> Registrar </a></p>
                        @endif

                    </form>
                </div>
            </div>
       
    </div>
</div>
@endsection