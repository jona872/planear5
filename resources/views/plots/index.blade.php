@extends('layouts.app')

@section('content')

<div id="react-js"></div> 

@endsection

@push('react-js-include')
<script src="{{ asset('js/app.js') }}" defer></script>

