@extends('layouts.web.sidebar')

@push('styles')
    <link rel="stylesheet" href="{{ elixir('css/pages/login.css') }}">
@endpush

@section('content')
    admin page
@endsection

@push('scripts')
    <script src="{{ elixir('js/pages/login.js') }}"></script>
@endpush