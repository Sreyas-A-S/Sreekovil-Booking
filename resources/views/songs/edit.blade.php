@extends('layouts.app')

@section('header', 'Edit Song')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl border border-maroon-900/10">
        @include('songs.partials.form', ['song' => $song])
    </div>
@endsection