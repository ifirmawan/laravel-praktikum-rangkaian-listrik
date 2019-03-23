@php
    $edit = false;
    isset($data) ? $edit = true : $edit = false;
@endphp

@extends('admin.master')

@section('content')
    <div class="content">
        <h1>Aktivitas</h1>
    </div>

    @if ($success = Session::get('success'))
        <div class="notification is-success">{{ $success }}</div>
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
                <form action="{{ route('admin.aktivitas.update', $data->id) }}" method="POST">
            @else
                <form action="{{ route('admin.aktivitas.store') }}" method="POST">
            @endif
                @csrf
                <div class="field">
                    <label class="label">Mata Kuliah</label>
                    <div class="control">
                        <div class="select">
                            <select name="id_mk" required>
                                @foreach($matkul as $item)
                                    <option @if($edit && $data->id_mk==$item->id) selected @endif
                                    value="{{ $item->id }}">{{ $item->nama_mk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Kelas</label>
                    <div class="control">
                        <div class="select">
                            <select name="id_kelas" required>
                                @foreach($kelas as $item)
                                    <option @if($edit && $data->id_kelas==$item->id) selected @endif
                                    value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Kode Akses</label>
                    <div class="control">
                        <input type="text" style="width: 200px;" class="input" name="password" min="5" required
                        @if ($edit) value="{{ $data->password }}" @endif/>
                    </div>
                </div>

                <button type="submit" class="button is-primary">
                    {{ $edit ? 'Simpan' : 'Tambah' }}
                </button>

                @if($edit)
                    <a class="button" href="{{ route('admin.aktivitas.add') }}">
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
                        Daftar Aktivitas
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">

                    </a>
                </header>
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped" style="margin: 20px 0px;">
                            <thead>

                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Kode Akses</th>
                            <th>Aksi</th>
                            </thead>
                            <tbody>

                            @foreach($aktivitas as $item)
                                <tr>

                                    <td>{{ $item->matkul->nama_mk }}</td>
                                    <td>{{ $item->kelas->nama_kelas }}</td>
                                    <td>{{ $item->password }}</td>

                                    <td>


                                        <form action="{{ route('admin.aktivitas.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.aktivitas.edit', $item->id) }}"
                                               class="button is-primary is-small">Edit</a>
                                            <button type="submit"
                                                    onclick="return confirm('Apakah anda yakin untuk menghapus aktivitas ini ?');"
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
                    {{ $aktivitas->links('pagination') }}
                </div>

            </div>
        </div>

    </div>

@endsection