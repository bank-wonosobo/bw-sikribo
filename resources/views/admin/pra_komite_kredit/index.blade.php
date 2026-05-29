@extends('admin.templates.app')

@section('title', 'Arsip Pra Komite Kredit')

@section('content')
<div class="row">
    @include('admin.pra_komite_kredit.list')
</div>
@endsection
