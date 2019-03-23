@php
    $edit = false;
    ( isset($laporan) ? $edit = true : $edit = false );
@endphp

@extends('mahasiswa.master')
@push('head')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@push('javascript')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush

@push('script')
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd"});
        } );
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="column is-8 is-offset-2 wrapper">

            <div class="content">
                <h2>{{ $modul->nama_modul }}</h2>
            </div>

            @if ($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


                <div class="card" style="margin-top: 40px;">
                <header class="card-header">
                    <p class="card-header-title">
                         {{ ($edit ? 'Ubah Laporan' : 'Kumpulkan Laporan') }}
                    </p>
                </header>

                <form enctype="multipart/form-data" method="POST"
                      @if($edit)
                        action="{{ route('mahasiswa.edit.resume', [$aktivitas->id, $modul->id]) }}"
                      @else
                        action="{{ route('mahasiswa.submit.resume', [$aktivitas->id, $modul->id]) }}"
                      @endif
                >
                    @csrf
                    <div class="card-content">
                        <div class="content">
                            <div class="field">
                                <label class="label">File Laporan (*.pdf)</label>
                                <div class="control">
                                    <input class="input" name="file" type="file" placeholder="File Laporan" {{ $edit ? '': 'required' }}>
                                </div>
                                <small>Ukuran maksimum file: 3 MB</small>
                                @if($edit)<small>. Kosongkan bila tidak ingin mengganti file</small> @endif
                            </div>

                            <div class="field">
                                <label class="label">Tanggal Praktikum</label>
                                <div class="control">
                                    <input class="input" name="tgl_praktikum"
                                           type="text" id="datepicker" placeholder="Tanggal Praktikum"
                                           value="{{ $edit ? $laporan->tgl_praktikum:'' }}"
                                    required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Asisten</label>
                                <div class="select">
                                    <select name="id_asisten" required>
                                        @foreach($asisten as $a)
                                        <option value="{{ $a->user->id }}"
                                        @if($edit)
                                            @if($a->user->id==$laporan->id_asisten) selected @endif
                                        @endif
                                        >
                                            {{ $a->user->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Pesan</label>
                                <div class="control">
                                    <textarea name="pesan" class="textarea"
                                              placeholder="Masukan pesan" 
                                              minlength="20">{{ $edit ? $laporan->pesan : '' }}</textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                    <footer class="card-footer">
                        <button type="submit"
                                class="card-footer-item button is-primary is-medium"
                                style="border-radius: 0; padding: 0;">
                            {{ $edit ? 'Ubah' : 'Kirim' }}
                        </button>
                        <a
                            @if ($edit)
                                href="{{ route('mahasiswa.modul.view', [$aktivitas->id, $matkul->id]) }}"
                            @else
                                href="{{ route('mahasiswa.matkul', $aktivitas->id) }}"
                            @endif
                            class="card-footer-item button is-medium"
                            style="border-radius: 0; padding: 0;">
                            Batal
                        </a>

                    </footer>
                </form>
            </div>


        </div>
    </div>
@endsection