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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">

    @stack('head')
</head>

<body>


<div class="container" style="margin-top: 50px;">
    <div class="columns">
        <div class="column is-2 ">
            <aside class="menu ">
                {{--<p class="menu-label">--}}
                    {{--UMUM--}}
                {{--</p>--}}
                {{--<ul class="menu-list">--}}
                    {{--<li><a href="{{ route('admin.aktivitas') }}">Aktivitas</a></li>--}}
                    {{--<li><a href="{{ route('admin.peserta') }}">Peserta</a></li>--}}
                {{--</ul>--}}
                <p class="menu-label">
                    ADMINISTRASI
                </p>
                <ul class="menu-list">
                    <li>
                        <a>Master</a>
                        <ul>
                            <li><a @if(Route::currentRouteName()=='admin.aktivitas.add') class="is-active" @endif
                                href="{{ route('admin.aktivitas.add') }}">Aktivitas</a></li>
                            <li><a @if(Route::currentRouteName()=='admin.matkul.add') class="is-active" @endif
                                href="{{ route('admin.matkul.add') }}">Mata Kuliah</a></li>
                            <li><a @if(Route::currentRouteName()=='admin.kelas.add') class="is-active" @endif
                                href="{{ route('admin.kelas.add') }}">Kelas</a></li>
                            <li><a @if(Route::currentRouteName()=='admin.pengguna') class="is-active" @endif
                                href="{{ route('admin.pengguna') }}">Pengguna</a></li>

                        </ul>
                    </li>


                </ul>

            </aside>
        </div>
        <div class="column is-10">
            @yield('content')
        </div>
    </div>
</div>


<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
@stack('javascript')
@stack('script')
</body>
</html>