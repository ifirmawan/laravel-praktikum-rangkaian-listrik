@extends('admin.master')

@section('content')



<div class="columns">
    <div class="column">
        <div class="card events-card">
            <header class="card-header">
                <p class="card-header-title">
                    Daftar Aktivitas
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
                            <th>ID</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Dosen</th>
                            <th>Asisten</th>
                            <th>Mahasiswa</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>

                        @foreach($aktivitas as $item)
                        <tr>
                            <td width="5%">{{ $item->id }}</td>
                            <td>{{ $item->matkul->nama_mk }}</td>
                            <td>{{ $item->kelas->nama_kelas }}</td>
                            <td>
                                @php
                                    $dosen = \App\Peserta::where('id_aktivitas', $item->id)
                                    ->whereHas('user', function($query)
                                    {
                                    $query->where('role','1')->orderBy('NIM');
                                    })->first();

                                    echo ($dosen) ? $dosen->user->name:'';
                                @endphp
                            </td>
                            <td>
                                @php
                                    $asisten = \App\Peserta::where('id_aktivitas', $item->id)
                                    ->whereHas('user', function($query)
                                    {
                                    $query->where('role','2')->orderBy('NIM');
                                    })->count();

                                    echo $asisten;
                                @endphp
                            </td>
                            <td>
                                @php
                                    $mhs = \App\Peserta::where('id_aktivitas', $item->id)
                                    ->whereHas('user', function($query)
                                    {
                                    $query->where('role','3')->orderBy('NIM');
                                    })->count();

                                    echo $mhs;
                                @endphp
                            </td>
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