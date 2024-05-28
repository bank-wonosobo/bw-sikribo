@extends('admin.templates.app')

@section('content')
<div class="row d-flex my-4">
    <div class="col-md-8">
        <a href="{{ route('admin.users.index') }}" class="btn btn-success mb-2">Kembali</a>
        <div class="d-flex my-3 ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                Create Password
            </button>
            @include('admin.users.create-password-modal')
            <form onSubmit="if(!confirm('Yakin ingin generate password ?')){return false;}" method="POST" action="{{ route('admin.users.generate-password', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-info">Generate Password</button>
            </form>
        </div>
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buat User</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.update', ['id' => $user->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}"></input>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hak Akses</label>
                        <select multiple name="roles[]" class="form-control select2" style="width: 100%;">
                            @foreach ($role as $item)
                                <option value="{{ $item->id }}" class="font-weight-bold" @if (in_array($item->name, $user->roles->pluck('name')->toArray()))
                                    selected
                                @endif>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Ubah User</button>
                </form>
            </div>
        </div>
    </div>
</div>
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
