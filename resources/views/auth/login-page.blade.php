<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS-->
    <link href="{{ asset('css/logcad-page.css') }}" rel="stylesheet">

    <!--CSS-BOOTSTRAP-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">

    <title>Login</title>
</head>

<body>
<div class="containerLR" style="background-image: url({{ asset('img/capa-fundo-login-register.png') }});">
    <div class="subcontainerLR">
        <span class="titleLR">Olá! Seja bem vindo</span>

        <div class="imgL">
            <img src="{{ asset('img/capa-login.png') }}" alt="IMG">
        </div>

        <div class="formLR">
            <div class="inputcontainer" data-validate="Valid email is required: ex@abc.xyz">
                <input class="input100" type="text" name="email" placeholder="Email">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>

            <div class="inputcontainer" data-validate="Password is required">
                <input class="input100" type="password" name="pass" placeholder="Password">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
            </div>

            <div class="inputcontainer">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="button__text" for="remember">
                    Manter Conectado
                </label>
            </div>

            <button class="btnLR">Entrar</button>

            <div class="text-center p-t-12">
                <span class="esqsenha">Esqueceu a</span><a class="esqsenha" href="{{ route('password.request') }}"> Senha?</a>
            </div>


            <div class="loginsocial">
                <div type="button" class="button" id="buttongoogle">
                    <a class="button__text" href="{{ route('social.login', ['driverProvider' => 'google']) }}"><i class="fab fa-google fa-3x" id="fa-google"></i>Entrar com Google</a>
                </div>
                <div type="button" class="button" id="buttongithub">
                    <a class="button__text" href="{{ route('social.login', ['driverProvider' => 'github']) }}"><i class="fab fa-github"></i>Entrar com GitHub</a>
                </div>
                <div type="button" class="button" id="buttonlinkedin">
                    <a class="button__text" href="{{ route('social.login', ['driverProvider' => 'facebook']) }}"><i class="fab fa-facebook-f"></i>Entrar com Facebook</a>
                </div>
            </div>


            <div class="text-center p-t-136">
                <a class="login" href="{{ route('register.page') }}">Criar conta
                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>
</body>

</html>
