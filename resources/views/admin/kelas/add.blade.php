@php
    $edit = false;
    isset($data) ? $edit = true : $edit = false;
@endphp

@extends('admin.master')

@section('content')
    <div class="content">
        <h1>Kelas</h1>
    </div>

    @if ($success = Session::get('success'))
        <div class="notification is-success">{{ $success }}</div>
    @endif

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

    <div class="card">
        <div class="card-content">

            @if($edit)
                <form action="{{ route('admin.kelas.update', $data->id) }}" method="POST">
                    @else
                        <form action="{{ route('admin.kelas.store') }}" method="POST">
                            @endif
                            @csrf


                            <div class="field">
                                <label class="label">Nama Kelas</label>
                                <div class="control">
                                    <input type="text" style="" class="input" name="nama_kelas" required
                                           @if ($edit) value="{{ $data->nama_kelas }}" @endif/>
                                </div>
                            </div>

                            <button type="submit" class="button is-primary">
                                {{ $edit ? 'Simpan' : 'Tambah' }}
                            </button>

                            @if($edit)
                                <a class="button" href="{{ route('admin.kelas.add') }}">
                                    Batal
                                </a>
                            @endif
                        </form>
        </div>
    </div>


    <div class="columns">
        <div class="column">
            <div class="card events-card">
                <header class="card-header">
                    <p class="card-header-title">
                        Daftar Kelas
                    </p>

                </header>
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped" style="margin: 20px 0px;">
                            <thead>
                            <th>Nama Kelas</th>

                            <th>Aksi</th>
                            </thead>
                            <tbody>

                            @foreach($kelas as $item)
                                <tr>
                                    <td>{{ $item->nama_kelas }}</td>

                                    <td>


                                        <form action="{{ route('admin.kelas.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.kelas.edit', $item->id) }}"
                                               class="button is-primary is-small">Edit</a>
                                            <button type="submit"
                                                    onclick="return confirm('Apakah anda yakin untuk menghapus kelas ini ?');"
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
                </div>

                <div style="padding: 20px;">
                    {{ $kelas->links('pagination') }}
                </div>

            </div>
        </div>

    </div>

@endsection