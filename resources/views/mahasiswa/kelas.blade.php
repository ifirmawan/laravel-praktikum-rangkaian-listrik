@extends('mahasiswa.master')

@section('content')
    <div class="container">
        <div class="column is-8 is-offset-2 wrapper">

            <div class="card profile">
                <div class="card-content">
                    <div class="media">
                        <figure class="media-left">
                            <p class="image is-64x64 is-rounded">
                                <img class="is-rounded" src="{{ $user->photo_url }}">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <span style="font-weight: bold; font-size: 18px;">{{ ucwords($user->name) }}</span>
                                    <br>
                                    <b>{{ $user->NIM }}</b><br>
                                    {{ $user->phone }}
                                </p>
                            </div>
                            <nav class="level is-mobile is-pulled-left">
                                <div class="level-item">
                                    <a href="{{ route('mahasiswa.profil') }}" class="button is-primary is-outlined is-small">
                                        <span class="icon">
                                          <i class="fas fa-edit"></i>
                                        </span>
                                        <span>Ubah Profil</span>
                                    </a>
                                </div>
                                <div class="level-item">
                                    <a href="{{ route('site.logout') }}" class="button is-danger is-outlined is-small">
                                        <span class="icon">
                                          <i class="fas fa-sign-out-alt"></i>
                                        </span>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">

                    <div class="columns is-mobile">
                        <div class="column">
                            <h3 class="is-pulled-left" style="margin-top: 10px;">Mata Kuliah</h3>
                        </div>
                        <div class="column">
                            <a href="{{ route('mahasiswa.kelas') }}" class="button is-primary is-medium  is-pulled-right">
                                        <span class="icon">
                                          <i class="fas fa-plus"></i>
                                        </span>
                                <span>Tambah</span>
                            </a>
                        </div>
                    </div>


                @if($aktivitas->count()==0)
                <div class="card profile" style="margin-top: 30px;">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p>
                                    <span style="font-weight: bold; font-size: 18px;">Tidak ada mata kuliah yang diambil</span>
                                    <br>
                                    Klik tombol <b>Tambah</b> untuk menambahkan mata kuliah
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @else

                <div class="module">

                        @foreach($aktivitas as $item)

                            @if ($item->as_asisten=='0')
                                <div class="card module-list">
                                <div class="card-content">
                                    <div class="level is-mobile">
                                        <div class="level-left">
                                            <div class="level-item">
                                                <div>
                                                <a href="{{ route('mahasiswa.matkul', $item->aktivitas->id) }}"><b>{{ $item->aktivitas->matkul->nama_mk }}</b></a><br>
                                                <b>{{ $item->aktivitas->kelas->nama_kelas }}</b><br>

                                                    @php
                                                        $dosen = \App\Peserta::where('id_aktivitas', $item->aktivitas->id)
                                                        ->whereHas('user', function($query)
                                                        {
                                                        $query->where('role','1')->orderBy('NIM');
                                                        })->first();

                                                        echo ($dosen) ? $dosen->user->name:'';
                                                    @endphp

                                                </div>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="level-item">
                                                {{--<span class="icon is-small is-completed"><i class="fas fa-check"></i></span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach

                </div>

                @endif
            </div>

        </div>
    </div>
@endsection