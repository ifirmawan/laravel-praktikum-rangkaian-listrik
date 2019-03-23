@extends('mahasiswa.master')

@section('content')
    <div class="container">
        <div class="column is-8 is-offset-2 wrapper">


            <div class="content">

                <div style="margin-bottom: 40px;">
                    <div style="font-weight: bold; font-size: 28px;">{{ $matkul->nama_mk }}</div>
                    <b>{{ $aktivitas->kelas->nama_kelas }}</b><br>

                    @php
                        $dosen = \App\Peserta::where('id_aktivitas', $aktivitas->id)
                        ->whereHas('user', function($query)
                        {
                        $query->where('role','1')->orderBy('NIM');
                        })->first();

                        echo ($dosen) ? $dosen->user->name:'';
                    @endphp

                </div>


                <div class="card" style="margin: 10px 0px; margin-bottom: 50px;">
                    <div class="card-content">


                        @php

                        $total = $modul->count();
                        $dikumpulkan = 0; $blm_dikumpulkan = 0;

                        foreach ($modul as $item):
                            $laporan = \App\Laporan::where('id_user', $user->id)
                                                    ->where('id_modul', $item->id)
                                                    ->count();
                            if ($laporan>0)
                            {
                                $dikumpulkan++;
                            }else{
                                $blm_dikumpulkan++;
                            }

                        endforeach;

                        @endphp


                        <nav class="level">
                            <div class="level-item has-text-centered">
                                <div>
                                    <p class="heading">Jumlah Modul</p>
                                    <p class="title">{{ $modul->count() }}</p>
                                </div>
                            </div>
                            <div class="level-item has-text-centered">
                                <div>
                                    <p class="heading">Dikumpulkan</p>
                                    <p class="title">{{ $dikumpulkan }}</p>
                                </div>
                            </div>
                            <div class="level-item has-text-centered">
                                <div>
                                    <p class="heading">Belum Dikumpulkan</p>
                                    <p class="title"> {{ $blm_dikumpulkan }}</p>
                                </div>
                            </div>

                        </nav>
                    </div>
                </div>

                <h3>Modul Praktikum</h3>

                <div class="module">

                    @foreach($modul as $item)
                    <div class="card module-list">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-left">
                                    <div class="level-item">
                                        <a href="{{ route('mahasiswa.modul.view', [$aktivitas->id, $item->id]) }}"><b>{{ $item->nama_modul }}</b></a>
                                    </div>
                                </div>

                                @php
                                    $laporan = \App\Laporan::where('id_user', $user->id)
                                                            ->where('id_modul', $item->id)
                                                            ->count();
                                @endphp
                                @if ($laporan >0)
                                <div class="right">
                                    <div class="level-item">
                                        <span style="margin-right: 10px;" class="icon is-small is-completed"><i class="fas fa-check"></i></span>
                                        <b>Sudah Dikumpulkan</b>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>

            </div>

        </div>
    </div>
@endsection