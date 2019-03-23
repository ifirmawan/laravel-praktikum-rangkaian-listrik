@extends('mahasiswa.master')

@section('content')
    <div class="container">
        <div class="column is-6 is-offset-3" style="padding-bottom: 0px;">
            <div class="card" style="margin-top: 40px; margin-bottom: 66px; max-width: 700px;">
        <header class="card-header">
            <p class="card-header-title">
                Ubah Profil
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

                <form method="POST" enctype="multipart/form-data" action="{{ route('mahasiswa.profil.save') }}">
                    @csrf

                    <div class="level is-mobile">
                        <div class="level-item">
                            <p class="image is-96x96 is-rounded">
                                <img class="is-rounded" src="{{ $user->photo_url }}">
                            </p>
                        </div>
                        <div class="level-item ">
                            <div class="field">
                                <label class="label">Foto (*.jpg; *.jpeg; *.png)</label>
                                <div class="control">
                                    <input class="input is-medium" name="photo" type="file" placeholder="Foto">
                                </div>
                                <small>Ukuran maksimum: 1 MB</small><br>
                                <small>Kosongkan bila tidak ingin mengganti foto</small>
                            </div>
                        </div>
                    </div>


                    <div class="field">
                        <label class="label">NIM</label>
                        <div class="control">
                            <input class="input is-medium" name="NIM" type="number" value="{{ $user->NIM }}" disabled>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nama Lengkap</label>
                        <div class="control">
                            <input class="input is-medium" name="name" type="text" minlength="10"
                                   maxlength="50" placeholder="Nama Lengkap" value="{{ $user->name }}" required>
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
                                <input class="input is-medium" name="phone" type="number" value="{{ substr($user->phone, 3) }}"
                                       minlength="5" maxlength="15" placeholder="No HP / WhatsApp" required>
                            </p>
                        </div>

                    </div>





                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input is-medium" name="email" type="email" placeholder="Email" value="{{ $user->email }}" disabled>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Kata Sandi</label>
                        <div class="control">
                            <input class="input is-medium" name="password" type="password" minlength="6" placeholder="Kata Sandi">
                        </div>
                        <small>Kosongkan bila tidak ingin mengganti kata sandi</small>
                    </div>


                    <div style="text-align: center">
                        <button type="submit" class="button is-primary is-large">Simpan</button>
                        <a href="{{ route('mahasiswa.index') }}" class="button is-large">Batal</a>
                    </div>

                </form>

            </div>
        </div>


    </div>
        </div>
    </div>
@endsection