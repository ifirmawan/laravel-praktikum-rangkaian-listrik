<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.4-->
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
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
</section>

<div class="column is-6 is-offset-3" style="padding-bottom: 0px;">



    <div class="card" style="margin-top: 40px; margin-bottom: 66px; max-width: 700px;">
        <header class="card-header">
            <p class="card-header-title">
                Buat Akun
            </p>
        </header>



        <div class="card-content">

            @if ($fail = Session::get('fail'))
                <div class="notification is-danger">{{ $fail }}</div>
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

            <div class="content">

                <form method="POST" enctype="multipart/form-data" action="{{ route('mahasiswa.register') }}">
                    @csrf
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input is-medium" name="email" type="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Kata Sandi</label>
                    <div class="control">
                        <input class="input is-medium" name="password" type="password" minlength="6" placeholder="Kata Sandi" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">NIM</label>
                    <div class="control">
                        <input class="input is-medium" name="NIM" type="number" placeholder="NIM" minlength="8" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Nama Lengkap</label>
                    <div class="control">
                        <input class="input is-medium" name="name" type="text" minlength="10"
                               maxlength="50" placeholder="Nama Lengkap" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">No. HP/WA</label>
                    <div class="field has-addons">
                        <p class="control">
                            <a class="button is-static is-medium">
                                +62
                            </a>
                        </p>
                        <p class="control is-expanded">
                            <input class="input is-medium" name="phone" type="number" minlength="5" maxlength="15" placeholder="No HP / WhatsApp" required>
                        </p>
                    </div>

                </div>

                <div class="field">
                    <label class="label">Foto (*.jpg; *.jpeg; *.png)</label>
                    <div class="control">
                        <input class="input is-medium" name="photo" type="file" placeholder="Foto" required>
                    </div>
                    <small>Ukuran maksimum: 3 MB</small>
                </div>


                <div style="text-align: center">
                <button type="submit" class="button is-primary is-large">Daftar</button>
                <a href="{{ route('site.login') }}" class="button is-large">Batal</a>
                </div>

                </form>

            </div>
        </div>


    </div>


</div>

</body>
</html>

