@extends('admin.templates.app')

@section('title', 'Kategori Kredit')

@section('content')
<div class="row">
    @include('admin.kategori_kredit.list')
    @include('admin.kategori_kredit.create')
</div>
@endsection
