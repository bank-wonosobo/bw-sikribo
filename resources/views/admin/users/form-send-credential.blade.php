{!! Form::open(['route' => 'admin.users.send-credential', 'method' => 'POST']) !!}
    <input type="hidden" name="nama" value="{{ Session::get('user')->name }}">
    <input type="hidden" name="email" value="{{ Session::get('user')->email }}">
    <input type="hidden" name="password" value="{{ Session::get('user')->password }}">
    <button type="submit" class="btn btn-success">Kirim Email</button>
{!! Form::close() !!}
