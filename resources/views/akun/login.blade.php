<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Praktikum</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.4-->
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>

<body>
<section class="hero is-success is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Login</h3>
                <p class="subtitle has-text-grey">Masuk untuk memulai</p>
                <div class="box">
                    <figure class="avatar">
                        <img class="is-32x32" src="{{ asset('img/ittp.png') }}">
                    </figure>
                    <form action="{{ route('site.authenticate') }}" method="POST">
                        @csrf
                        @if ($fail = Session::get('fail'))
                            <div class="notification is-danger">{{ $fail }}</div>
                        @endif

                        @if ($success = Session::get('success'))
                            <div class="notification is-danger">{{ $success }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="notification is-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="field">
                            <div class="control">
                                <input name="nim" class="input is-large" type="text" placeholder="NIM" autofocus="" minlength="6" required>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input name="password" class="input is-large" type="password" minlength="6" placeholder="Kata Sandi" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="checkbox">
                                <input type="checkbox" name="remember">
                                Ingat saya
                            </label>
                        </div>
                        <button type="submit" class="button is-block is-primary is-large is-fullwidth">Login</button>
                    </form>
                </div>
                <p class="has-text-grey">
                    {{--<a href="{{ route('site.register') }}">Daftar Baru</a> &nbsp;·&nbsp;--}}
                    <a href="../">Lupa Password ?</a>
                </p>
            </div>
        </div>
    </div>
</section>
<script async type="text/javascript" src="../js/bulma.js"></script>
</body>

</html>
