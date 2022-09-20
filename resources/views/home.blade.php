@extends('layout.sbadmin')

@section('content')
<h1 class="mt-4">Home</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Home</li>
</ol>
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

{{ __('You are logged in!') }}

@endsection
