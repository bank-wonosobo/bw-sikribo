@extends('admin.templates.app')

@section('content')
<div class="row my-4">
    <div class="col-md-8">
        <a href="{{ route('admin.users.index') }}" class="btn btn-success mb-2">Kembali</a>
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buat User</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('name') }}"></input>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hak Akses</label>
                        <select multiple name="roles[]" class="form-control select2" style="width: 100%;">
                            @foreach ($role as $item)
                                <option value="{{ $item->id }}" class="font-weight-bold">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Buat User</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if($refund = Session::has('password-show'))
    <div class="row my-4">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Detail User</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        Password hanya akan ditampilan 1 kali !!. copy password agar tidak lupa ya
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ Session::get('user')->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ Session::get('user')->email }}</td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td class="font-weight-bold">{{ Session::get('user')->password }}</td>
                        </tr>
                        <tr>
                            <td>Hak Akses</td>
                            <td>:</td>
                            <td>
                                @foreach(Session::get('user')->roles  as $role)
                                    <span class="badge bg-dark">{{ $role->name }} </span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    @include('admin.users.form-send-credential')
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
    <!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2({
                width: 'resolve' // need to override the changed default
            });
        });
    </script>
@endsection
