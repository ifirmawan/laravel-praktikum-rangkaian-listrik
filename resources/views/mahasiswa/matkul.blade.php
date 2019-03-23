@extends('mahasiswa.master')

@section('content')
    <div class="container">
        <div class="column is-8 is-offset-2 wrapper">

               <div class="content">

                <h3>Mata Kuliah Tersedia</h3>

                 <div class="module" style="margin-top: 40px;">

                     @if ($fail = Session::get('fail'))
                         <div class="notification is-danger">{!! $fail  !!}</div>
                     @endif

                    @foreach($aktivitas as $item)
                        <div class="card module-list">
                            <div class="card-content">
                                <div class="level is-mobile">
                                    <div class="level-left">
                                        <div class="level-item">
                                            <div>
                                               <b>{{ $item->matkul->nama_mk }}</b><br>
                                                {{ $item->kelas->nama_kelas }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="level-item">

                                            @php

                                            $peserta = \App\Peserta::where('id_aktivitas', $item->id)
                                                                    ->where('id_user', $user->id)
                                                                    ->count();
                                            @endphp

                                            @if($peserta==0)
                                            <form method="POST" action="{{ route('mahasiswa.kelas.join', $item->id) }}">
                                                @csrf
                                                <div class="field has-addons">
                                                    <div class="control">
                                                        <input minlength="5" class="input" name="password" type="text" placeholder="Kode akses" required>
                                                    </div>
                                                    <div class="control">
                                                        <button type="submit" class="button is-primary">
                                                            Gabung
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            @else
                                                <span style="margin-right: 10px;" class="icon is-small is-completed"><i class="fas fa-check"></i></span> <b>Sudah Bergabung</b>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </div>
@endsection