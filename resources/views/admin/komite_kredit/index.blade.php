@extends('admin.templates.app')

@section('title', 'Arsip Komite Kredit')

@section('content')
<div class="row">
    @include('admin.komite_kredit.list')
</div>
@endsection
