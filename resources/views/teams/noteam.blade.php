@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / Scrim </span>
</section>
<div class="container mt-12 max-w-6xl mr-2">
    <div class="bg-dark-100 border-t border-b border-purple-500 text-purple-400 px-4 py-3 " role="alert">
        <p class="font-bold text-lg">You currently do not have any team</p>
        <p class="text-md italic">Please create your own team or wait for invitation.</p>
    </div>
    <div class="flex justify-center">
        <a href="/teams/create" class="btn-indigo text-white font-bold
        py-4 px-6 rounded-full w-64 shadow-md mt-4 text-center">Create New Team</a>
    </div>
</div>
@endsection
