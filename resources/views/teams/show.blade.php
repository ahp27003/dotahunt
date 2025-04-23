@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / Team / <a href="/teams/{{$team->id}}"
        class="no-underline hover:underline text-blue-500">{{$team->name}}</a></span>
</section>
<div class="container ml-20 mt-12 font-mono">
    <p class="ml-1 pb-4 text-2xl font-bold text-purple-600 uppercase">Team profile</p>
    <div class="flex flex-wrap">
        <div class="w-2/5">
            <div class="flex flex-col bg-dark-100 shadow-lg rounded-lg mr-4">
                <div class="w-full px-10 bg-purple-700   relative text-center pb-1">
                        <span class="text-white font-semibold text-2xl capitalize text-center">Team {{$team->name}}</span>
                </div>

                <div class="flex justify-center my-2">
                        <img src="{{  asset('storage/pics/' . $team->image) }}" alt="" class=" rounded-sm w-3/5">
                </div>

                <div class="w-full px-10 bg-purple-700">
                        <p class="font-semibold text-xl capitalize text-center text-white ">Team Information</p>
                </div>
                <div class="flex flex-col  items-center mt-2 mx-10 mb-2 text-white">
                    <p class="text-center"><span class="font-semibold">City:</span> {{$team->area}}</p>
                    <p class="text-center"><span class="font-semibold">State:</span> {{$team->state}}</p>
                    <p class="text-center"><span class="font-semibold">Captain:</span>
                        <a href="/players/{{$captain->accounts->dota_id}}" class="no-underline hover:underline text-blue-600">{{$captain->name}}</a></p>
                    <p class="text-center"><span class="font-semibold">Sponsor:</span> {{$team->sponsor}}</p>
                    <p class="text-center"><span class="font-semibold">Description:</span>{{$team->description}}</p>
                    @if($team->scrim == true)
                    <p class="text-center"><span class="font-semibold">Scrim:</span> Ready</p>
                    @else
                    <p class="text-center"><span class="font-semibold">Scrim:</span> Not Ready</p>
                    @endif
                </div>

            </div>
        </div>
        <div class="w-2/4 rounded-lg">
            <div class="flex flex-col justify-content bg-dark-100 shadow-lg ml-4">
                    <div class="bg-purple-700 py-2">
                            <p class="text-white font-semibold text-2xl text-center">Player Roster</p>
                        </div>
                        <div>
                                <table class="border-collapse w-full">
                                        <thead class="text-white border-b border-gray-600">
                                            <th class="capitalize  py-4 text-center">ID</th>
                                            <th class="capitalize  py-4 text-center">Name</th>
                                            <th class="capitalize  py-4 text-center">Position</th>
                                            <th class="capitalize  py-4 text-center">Join Date</th>
                                            <th class="capitalize  py-4 "></th>
                                        </thead>
                                        <tbody class="text-center">
                                        @foreach($teamMembers as $teamMember)

                                        <tr class="hover:bg-content border-b border-gray-600 text-white font-semibold">
                                        <td class="py-4 px-6">{{$teamMember->accounts->steam_name}}</td>
                                        <td class="py-4 px-6 capitalize">{{$teamMember->name}}</td>
                                        @if($teamMember->knowledge()->exists() != false)
                                        <td class="py-4 px-6 capitalize">{{$teamMember->knowledge->mainRole()}}</td>
                                        @else
                                        <td class="py-4 px-6">Unknown</td>
                                        @endif
                                        @foreach($teamMember->team as $t)
                                        <td class="py-4 px-6 whitespace-no-wrap">{{$t->pivot->created_at->format('d-m-Y')}}</td>

                                        @endforeach
                                        <td class="py-4 px-6 flex">
                                            <a href="{{ url('/players/' . $teamMember->accounts->dota_id) }}">
                                                <i class="material-icons text-indigo-600 cursor-pointer md-48 hover:text-indigo-800">
                                                search
                                                </i>
                                            </a>
                                        </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection



{{-- @extends('layouts.app')

@section('content') --}}
{{-- <div class="container">
    <div class="row justify-content-center"> <div class="row">
            <div class="col-md-4">

                    <div class="card">
                        <div class="card-header">Team Members</div>

                        <div class="card" >
                                <div class="card-body">


                                <ul>

                        @foreach ($team->users as $player)

                                <li>
                                    @if ($player->id == $team->captain_id)
                                        <b>Captain:</b>
                                    @endif

                                    <a href="/players/{{ $player->accounts['dota_id']  }}">{{ $player->name }}</a> </li>
                        @endforeach

                    </ul>
                </div>

                          </div>

                    </div>


                    @foreach ($team->users as $player)


                        @if ($player->id === Auth::user()->id)
                            <div class="card">
                                <div class="card-header">Action</div>

                                <div class="card" >
                                        <div class="card-body">

                                        <a href="/leave/{{ $team->id }}" class="btn btn-warning "
                                                role="button" >Leave Team</a>


                                                {{-- Action for captain only --}}
                                                {{-- @if ($team->captain_id === Auth::user()->id)

                                                        @if($team->scrim == false)
                                                            <a href="/teams/scrim/{{ $team->id }}" class="btn btn-primary "
                                                            role="button" >Ready for scrim</a>
                                                        @else
                                                            <a href="/teams/notScrim/{{ $team->id }}" class="btn btn-info"
                                                            role="button" >Not Ready for scrim</a>
                                                        @endif

                                                <form action="/teams/{{ $team->id }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger ">Delete Team</button>
                                                    </form>
                                                @endif


                                        </div>
                                 </div>
                            </div>
                        @endif
                    @endforeach
                    @if (session('leave'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ session('leave') }}</li>
                        </ul>
                    </div>
                @endif





                    <div class="card">
                        <div class="card-header">Team notification</div>

                        <div class="card" >
                                <div class="card-body">
                                <a href="/tnotification" class="btn btn-primary btn-lg"
                                        role="button" aria-disabled="true">Notification</a>


                </div> --}}


                            {{-- <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                            </div> --}}
                        {{-- </div>

                    </div>


                </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card" >

                    <img src="{{  asset('storage/pics/' . $team->image) }}" class="rounded mx-auto d-block mw-100" alt="...">



                    <div class="card-body">
                      <h5 class="card-title text-center"><b>Team Name: {{ $team->name }}</b></h5>
                      <p class="card-text"></p>
                    </div>
                    <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><b>Area:</b> {{ $team->area }} </li>
                      <li class="list-group-item"><b>MMR ESTIMATE:</b> </li>
                      @if($team->scrim == true)
                        <li class="list-group-item"><b>Ready to scrim:</b><br><b>Ready</b></li>
                      @else
                        <li class="list-group-item"><b>Ready to scrim:</b><br><b>Not Ready</b></li>
                      @endif
                      <li class="list-group-item"><b>Game:</b> Dota</li>
                    </ul>

                  </div>

            </div>
        </div></div>

</div> --}}
{{-- @endsection --}}
