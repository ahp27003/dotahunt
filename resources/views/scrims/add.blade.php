@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / <a href="/scrims" class="text-blue-500 hover:underline">Scrim</a>  / Team
        <a href="/teams/{{ $team->id }}" class="text-blue-500 hover:underline">{{ $team->name }}</a></span>
</section>
{{-- //lg untuk laptop 1278 x XXX
//xl tuk desktop 1440 x 737 --}}
<div class="container ml-24 mt-12 font-mono">

                    <p class="text-2xl  ml-1 font-bold  pb-4 capitalize text-purple-600">Schedule Scrim</p>
                    <div class="flex justify-content">
                    <form method="POST" action="/scrims" class="bg-dark-100 shadow-lg w-5/12 rounded-lg pt-6 pb-4">
                        @csrf
                        <input name="team_id" type="hidden" value="{{ $myTeam->id }}">
                        <input name="opponent_id" type="hidden" value="{{ $team->id }}">
                        <div class="flex  flex-col justify-center items-center">
                        <div class="w-2/3 mb-3">
                            <label for="opponent" class="block text-white text-md font-bold mb-2">Opponent Team*</label>
                            <input class="cursor-not-allowed appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200
                            rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="name" id="name" value="{{$team->name}}" required disabled>
                        </div>
                        <div class="w-2/3 mb-3">
                            <label for="date_time" class="block text-white text-md font-bold mb-2">Date & Time*</label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200
                            rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="datetime-local" name="date_time" id="date_time" required>
                            @error('date_time')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-2/3">
                            <label for="date_time" class="block text-white text-md font-bold mb-2">Notes</label>
                            <textarea class="appearance-none block w-full  text-gray-700 border-2 border-gray-300 rounded
                                      py-3 px-4 leading-tight focus:outline-none focus:border-purple-500 bg-gray-300"
                                      rows="4" name="notes"></textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-row justify-center items-center mt-3">
                                <div class="mr-2">
                                        <a  href="javascript:history.back()"  class="inline-block bg-transparent rounded px-4 py-1
                                        text-md font-semibold text-white text-center hover:bg-purple-600 border-2 border-purple-500
                                        hover:text-white tracking-wide">Cancel</a>
                                </div>
                                <button type="submit" class="btn-indigo text-white font-bold py-2 px-4 rounded-lg">
                                        Invite
                                </button>
                        </div>

                        </div>
                    </form>
                </div>
            </div>
</div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invite Scrims</div>

                <div class="card-body">
                    <form method="POST" action="/scrims">
                        @csrf


                    <input name="team_id" type="hidden" value="{{ $myTeam->id }}">
                        <input name="opponent_id" type="hidden" value="{{ $team->id }}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Opponent Team</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $team->name }}" required autofocus disabled>

                             </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_time" class="col-md-4 col-form-label text-md-right">Date and time</label>

                            <div class="col-md-6">
                                <input id="date_time" type="datetime-local" class="form-control" name="date_time" required autofocus>

                             </div>


                        </div>

                        @error('date_time')
                             <div class="alert alert-warning">
                                <ul>
                                    <li>{{ $message }}</li>
                                </ul>
                            </div>
                                @enderror


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Invite
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
