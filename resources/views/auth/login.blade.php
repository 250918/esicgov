@extends('layouts.app-home')

@section('page', __('Login'))

@section('auth_content')
<div class="col-auto">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h5>{{ __('ACESSE O SISTEMA') }}</h5></div>

                <div class="card-body">
                    <div class="col-md-12 text-center">
                        <p>Preencha o Nome do Usuário e Senha para acessar o Sistema de Informações.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('Endereço de e-mail') }}</label>
                            <div class="col-md-12">
                                <input placeholder="email@email.com" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Senha') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 text-left">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Lembrar senha') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    {{ __('Acessar') }}
                                </button>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center mt-3">
                                <a class="btn btn-outline-success btn-lg w-100" href="http://www.narandiba.sp.gov.br/esic/register" role="button">
                                    {{ __('CRIAR UM CADASTRO') }}
                                </a>
                            </div>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Não lembro minha senha') }}
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
