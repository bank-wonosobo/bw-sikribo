@extends('admin.templates.app')

@section('title', 'Jenis Jaminan Kredit')

@section('content')
<div class="row">
    @include('admin.jenis_jaminan.list')
    @include('admin.jenis_jaminan.create')
</div>
@endsection
