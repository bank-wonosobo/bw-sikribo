@extends('admin.templates.app')

@section('title', 'Arsip Pemberkasan Kredit')

@section('content')
<div class="row">
    @include('admin.pemberkasan_kredit.list')
</div>
@endsection
