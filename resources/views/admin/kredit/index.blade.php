@extends('admin.templates.app')

@section('title', 'Arsip Jaminan/Kredit')

@section('content')
<div class="row">
    @include('admin.kredit.list')
</div>

{{-- @include('admin.kredit.create') --}}
@endsection
@include('admin.kredit.import')
