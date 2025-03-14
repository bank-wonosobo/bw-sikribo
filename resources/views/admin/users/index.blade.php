@extends('admin.templates.app')

@section('title', 'User')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if($refund = Session::has('password-show'))
            <div class="alert alert-warning mb-2">
                Berhasil generate password user ({{ Session::get('user')->name }}), <br>
                <b>Password  : {{ Session::get('user')->password }} </b>,<br>
                <p>Password hanya akan ditampilan 1 kali !!. copy password agar tidak lupa ya</p>
                @include('admin.users.form-send-credential')
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Manajemen</h5>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary my-3 shadow-sm">
                Tambah User
                </a>
                <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Hak Akses</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    {{-- {{ $item->roles()->get() }} --}}
                                    @foreach($item->roles as $role)
                                        <span class="badge bg-dark">{{ $role->name }} </span><br>
                                    @endforeach
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.users.edit', ['id' => $item->id]) }}" class="btn btn-primary btn-sm mr-1">Edit</a>
                                    <form method="post" action="{{ route('admin.users.delete', ['id' => $item->id ]) }}" onsubmit="return confirm('Konfirmasi Hapus Data . !!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
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
        </div>
    </div>
</div>
@endsection
