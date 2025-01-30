@extends('admin.templates.app')

@section('title', 'Hasil Slik')

@section('content')
<div class="row">
    @include('admin.hasil_slik.list')
</div>

@endsection
