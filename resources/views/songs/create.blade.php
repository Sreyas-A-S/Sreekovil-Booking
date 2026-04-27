@extends('layouts.app')

@section('header', 'Add New Song')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl border border-maroon-900/10">
        @include('songs.partials.form')
    </div>
@endsection