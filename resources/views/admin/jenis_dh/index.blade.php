@extends('admin.templates.app')

@section('title', 'Jenis Dokumen Hukum')

@section('content')
<div class="row">
    @include('admin.jenis_dh.list')
    @include('admin.jenis_dh.create')
</div>
@endsection
