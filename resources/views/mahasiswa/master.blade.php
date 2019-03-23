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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">

    @stack('head')
</head>

<body>

<section class="hero is-primary">

    <div class="container">
        <div class="hero-body">
            <h1 class="title">
                PRAKTIKUM
            </h1>
            <h2 class="subtitle">
                Institut Teknologi Telkom Purwokerto
            </h2>
        </div>
    </div>

    </div>

    @if(Route::currentRouteName()!=='site.index')
    <div class="column is-8 is-offset-2" style="padding-bottom: 0px;">

        <div class="tabs is-boxed is-centered">
            <ul>
                <li @if (Route::currentRouteName()=='mahasiswa.index') class="is-active" @endif>
                    <a href="{{ route('mahasiswa.index') }}">
                        <span class="icon is-small"><i class="fas fa-home" aria-hidden="true"></i></span>
                        <span>Beranda</span>
                    </a>
                </li>

                @if (Route::currentRouteName()=='mahasiswa.index' ||
                    Route::currentRouteName()=='mahasiswa.kelas' ||
                    Route::currentRouteName()=='mahasiswa.profil')
                <li @if (Route::currentRouteName()=='mahasiswa.kelas') class="is-active" @endif>
                    <a href="{{ route('mahasiswa.kelas') }}">
                        <span class="icon is-small"><i class="fas fa-book" aria-hidden="true"></i></span>
                        <span>Mata Kuliah</span>
                    </a>
                </li>
                @endif

                @if (Route::currentRouteName()!='mahasiswa.index' &&
                      Route::currentRouteName()!='mahasiswa.kelas' &&
                      Route::currentRouteName()!='mahasiswa.profil')
                <li @if (Route::currentRouteName()!='mahasiswa.matkul.peserta')
                    class="is-active" @endif>
                    <a href="{{ route('mahasiswa.matkul', $aktivitas->id) }}">
                        <span class="icon is-small"><i class="fas fa-list" aria-hidden="true"></i></span>
                        <span>Modul</span>
                    </a>
                </li>
                <li @if (Route::currentRouteName()=='mahasiswa.matkul.peserta') class="is-active" @endif>
                    <a href="{{ route('mahasiswa.matkul.peserta', $aktivitas->id ) }}">
                        <span class="icon is-small"><i class="fas fa-users" aria-hidden="true"></i></span>
                        <span>Peserta</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
    @endif

</section>

@yield('content')

<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
@stack('javascript')
@stack('script')
</body>
</html>

