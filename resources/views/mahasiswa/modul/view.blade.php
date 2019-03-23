@extends('mahasiswa.master')

@section('content')
    <div class="container">
        <div class="column is-8 is-offset-2 wrapper">

            <div class="content">
                <h2>{{ $modul->nama_modul }}</h2>
            </div>

            @if (session('success'))
                <div class="notification is-success">{{ session('success') }}</div>
            @endif

            @if (session('fail'))
                <div class="notification is-danger">{{ session('fail') }}</div>
            @endif


            <div class="card assignment">
                <div class="card-content">
                    <div class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="{{ asset('img/pdf.png') }}">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>
                                        <a href="{{ $laporan->pdf_url }}">
                                            {{ $laporan->pdf }}
                                        </a>
                                    </strong>
                                    <br>
                                    @php
                                        $tgl = \Carbon\Carbon::parse($laporan->tgl_praktikum)->locale('id_ID');
                                    @endphp

                                    Tanggal praktikum : {{ $tgl->format('l, d F Y') }}<br>


                                @if($laporan->pesan)
                                <blockquote>
                                    {!! nl2br(e($laporan->pesan)) !!}
                                </blockquote>
                                @endif


                                Telah dikumpulkan pada {{ \Carbon\Carbon::parse($laporan->created_at)->locale('id_ID')->format('l, d F Y H:i') }} WIB<br>
                                Asisten: <b>{{ $laporan->asisten->name }}</b><br>
                                </p>
                            </div>
                            <nav class="level is-mobile">
                                <div class="level-left">
                                    <p class="buttons">

                                    <form action="{{ route('mahasiswa.delete.resume', [$aktivitas->id, $modul->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('mahasiswa.modul.edit', [$aktivitas->id, $modul->id]) }}"
                                           class="button is-primary is-outlined">
                                            <span class="icon">
                                              <i class="fas fa-edit"></i>
                                            </span>
                                            <span>Ubah</span>
                                        </a>
                                        <button type="submit"
                                                onclick="return confirm('Apakah anda yakin untuk menghapus laporan ini ?');"
                                                class="button is-danger is-outlined">
                                            <span class="icon">
                                              <i class="fas fa-trash"></i>
                                            </span>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                    </p>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <a class="button is-primary is-medium" style="float: right; margin-top: 20px;"
               href="{{ route('mahasiswa.matkul', $aktivitas->id) }}">
                <span class="icon">
                  <i class="fas fa-arrow-left"></i>
                </span>
                <span>Kembali</span>
            </a>


        </div>
    </div>
@endsection