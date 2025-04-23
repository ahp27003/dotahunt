@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / Teams / List</a></span>
</section>
<div class="container mt-12">
        <div class="flex">
        <div class="w-5/6 ml-16 font-mono">
            <p class="text-2xl  ml-1 font-bold  pb-6 text-purple-600 uppercase">List of registered teams</p>
                <div class="bg-dark-100 shadow-lg text-center rounded-lg px-4 pb-6 pt-5">
                    <table class="border-collapse w-full">
                        <thead class="text-white tracking-wide text-lg border-b border-gray-600">
                            <th class="capitalize py-4 ">Name</th>
                            <th class="capitalize py-4 ">Description</th>
                            <th class="capitalize py-4 ">State</th>
                            <th class="capitalize py-4 ">Player</th>
                            <th class="capitalize py-4 "></th>
                        </thead>
                        <tbody class="text-center text-white font-semibold">
                            @foreach($teams as $team)
                                <tr class="hover:bg-content border-b border-gray-600">
                                <td class="flex flex-col items-center p-2">

                                    <img src="{{  asset('storage/pics/' . $team->image)  }}" alt="" class="rounded-full w-24 h-24">
                                    {{$team->name}}</td>
                                    <td class="py-4">{{$team->description}}</td>
                                <td class="py-4">{{$team->state}}</td>
                                <td class="py-4 px-6">{{  $team->qtty_member  }}</td>
                                <td class="py-4 px-6"><a href="/teams/{{  $team->id  }}" class="inline-block  rounded px-3 py-1
                                    text-md font-semibold text-white mt-3 text-center btn-indigo tracking-wide border-2 border-purple-800">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>


        </div>
        </div>
@endsection

