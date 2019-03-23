@extends('admin.master')

@section('content')



    <div class="columns">
        <div class="column">
            <div class="card events-card">
                <header class="card-header">
                    <p class="card-header-title">
                        Daftar Peserta
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped" style="margin: 20px 0px;">
                            <thead>

                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>

                            <th>Aksi</th>
                            </thead>
                            <tbody>

                            @foreach($peserta as $item)
                                <tr>

                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        @php
                                            switch ($item->user->role){
                                                case '1':
                                                    echo 'Dosen';
                                                    break;
                                                case '2':
                                                    echo 'Asisten';
                                                    break;
                                                case '3':
                                                    echo 'Mahasiswa';
                                                    break;
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $item->aktivitas->matkul->nama_mk }}</td>
                                    <td>{{ $item->aktivitas->kelas->nama_kelas }}</td>

                                    <td>
                                        <a class="button is-primary is-small">Aksi</a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection