@extends('admin.templates.app')

@section('title', 'Dokumen Hukum')

@section('content')
<div class="row">
    @include('admin.dokumen_hukum.list')
</div>

@endsection
