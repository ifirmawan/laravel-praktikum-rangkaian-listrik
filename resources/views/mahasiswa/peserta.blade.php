@extends('mahasiswa.master')

@section('content')
    <div class="container">
        <div class="column is-8 is-offset-2 wrapper">

            <div class="content" style="margin-bottom: 40px;">
                <h2>Dosen</h2>
            </div>

            @foreach($dosen as $item)
                <div class="card students">
                    <div class="card-content">
                        <div class="media">
                            <figure class="media-left">
                                <p class="image is-48x48">
                                    <img class="is-rounded" src="{{ $item->user->photo_url }}">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <span style="font-weight: bold; font-size: 16px;">{{ $item->user->name }}</span>
                                        <br>
                                        {{ $item->user->NIM }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="content" style="margin-bottom: 40px; margin-top: 40px;">
                <h2>Asisten Praktikum ({{ $asisten->count() }})</h2>
            </div>

            @foreach($asisten as $item)
                <div class="card students">
                    <div class="card-content">
                        <div class="media">
                            <figure class="media-left">
                                <p class="image is-48x48 is-rounded">
                                    <img src="{{ $item->user->photo_url }}">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <span style="font-weight: bold; font-size: 16px;">{{ $item->user->name }}</span>
                                        <br>
                                        {{ $item->user->NIM }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="content" style="margin-bottom: 40px; margin-top: 40px;">
                <h2>Mahasiswa ({{ $mahasiswa->count() }})</h2>
            </div>

            @foreach($mahasiswa as $item)
            <div class="card students">
                <div class="card-content">
                    <div class="media">
                        <figure class="media-left">
                            <p class="image is-48x48 is-rounded">
                                <img src="{{ $item->user->photo_url }}">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <span style="font-weight: bold; font-size: 16px;">{{ $item->user->name }}</span>
                                    <br>
                                    {{ $item->user->NIM }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



        </div>
    </div>
@endsection