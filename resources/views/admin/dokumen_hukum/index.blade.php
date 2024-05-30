@extends('admin.templates.app')

@section('title', 'Arsip Jaminan/Kredit')

@section('content')
<div class="row">
    @include('admin.dokumen_hukum.list')
</div>

@endsection
