@php
    $edit = false;
    isset($data) ? $edit = true : $edit = false;
@endphp

@extends('admin.master')

@section('content')
    <div class="content">
        <h1>Edit Pengguna</h1>
    </div>

    @if ($success = Session::get('success'))
        <div class="notification is-success">{{ $success }}</div>
    @endif

    @if ($fail = Session::get('fail'))
        <div class="notification is-danger">{{ $fail }}</div>
    @endif


    <div class="columns">
        <div class="column">
            <div class="card events-card">
                <header class="card-header">
                    <p class="card-header-title">
                        Edit Pengguna
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                        <form>
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <input type="text" class="input" name="search" minlength="3" placeholder="Cari" required>

                                </div>
                                <div class="level-item">
                                    <button type="submit" class="button is-primary">Cari</button>

                                </div>
                            </div>
                        </form>
                    </a>
                </header>
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped is-mobile" style="margin: 20px 0px;">
                            <thead>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>


                            <th>Aksi</th>
                            </thead>
                            <tbody>

                            @foreach($mhs as $item)
                                <tr>
                                    <td>{{ $item->NIM }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>

                                    <td>


                                        <form action="{{ route('admin.pengguna.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.pengguna.destroy', $item->id) }}"
                                               class="button is-primary is-small">Edit</a>
                                            <button type="submit"
                                                    onclick="return confirm('Apakah anda yakin untuk menghapus mahasiswa ini ?');"
                                                    class="button is-danger is-small">
                                                Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>


                    </div>

                    <div style="padding: 20px;">
                        {{ $mhs->links('pagination') }}
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection