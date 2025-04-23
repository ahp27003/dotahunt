@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="pt-2 ml-4 font-medium tracking-wide text-white">
        <span class="text-sm italic ">Home / Profile / <a href="{{url('/players/' . $users->accounts->dota_id)}}"
            class="text-blue-500 no-underline hover:underline">{{$users->name}}</a>  / Achievements</span>
   </section>

<div class="container mt-12 font-mono">
    @if (session('success'))
    <div class="flex flex-row-reverse mb-4">
        <div v-show="alert" class="relative px-4 py-3 -mt-8 text-green-700 bg-green-100 border border-green-400 rounded w-2/5" v-on:click="hideAlert" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="w-6 h-6 text-green-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
    @endif
<div class="flex flex-wrap">
<div class="ml-16 min-w-md">
    <p class="ml-1 text-2xl font-bold text-purple-600 uppercase">past achievements</p>
    <p class="pb-4 ml-1 text-md font-normal text-gray-600 italic">Record your past achievement here</p>
    @if($achievements->total() != 0)
        <div class="px-4 pt-5 pb-6 text-center rounded-lg shadow-lg bg-dark-100">
                {{-- <p class="pb-2 ml-4 text-xl font-bold underline uppercase">past achievements</p> --}}
            <table class="w-full border-collapse">
                <thead class="text-white">
                    <th class="py-4 capitalize border-b border-gray-600 ">#</th>
                    <th class="py-4 capitalize border-b border-gray-600 ">Tournament Name</th>
                    <th class="py-4 capitalize border-b border-gray-600 ">Team</th>
                    <th class="py-4 capitalize border-b border-gray-600 ">Place</th>
                    <th class="py-4 capitalize border-b border-gray-600 ">Date</th>
                    <th class="py-4 capitalize border-b border-gray-600 "></th>
                </thead>
                <tbody class="text-center">

                        @foreach($achievements as $achievement)
                        <tr class="text-white hover:bg-content">
                            <td class="px-6 py-4 border-b border-gray-600">{{$loop->index + 1}}</td>
                            <td class="px-6 py-4 border-b border-gray-600 capitalize">{{$achievement->tournament_name}}</td>
                            <td class="px-6 py-4 border-b border-gray-600 capitalize">{{$achievement->team}}</td>
                            <td class="px-6 py-4 border-b border-gray-600">
                                @if($achievement->place == 1)
                                Champion
                                @elseif($achievement->place == 2)
                                Top 4
                                @elseif($achievement->place == 3)
                                Top 8
                                @elseif($achievement->place == 4)
                                Top 18
                                @elseif($achievement->place == 5)
                                Others
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b border-gray-600">{{$achievement->date}}</td>
                            @if(Auth::user()->accounts->dota_id == $users->accounts->dota_id)
                            <td class="px-6 py-4 border-b border-gray-600">
                                <div class="flex">
                                        <a href="#" @click.prevent="$modal.show('edit-achievement',{ achievement: {{$achievement}} })">
                                                <span v-tooltip.top="'Edit this achievement'">
                                            <i class="text-indigo-600 cursor-pointer material-icons">
                                                create
                                                </i> </span></a>

                                                <form action="/players/{{$users->accounts->dota_id}}/achievements/{{$achievement->id}}" method="post">
                                                @csrf
                                                @method("delete")
                                                    <button type="submit">  <span v-tooltip.top="'Delete this achievement'"><i class="text-red-600 cursor-pointer material-icons">
                                                            delete_forever
                                                            </i></span></button>
                                                </form>
                                </div>

                                </td>

                                    @endif
                        </tr>
                        @endforeach
                </tbody>
                @else
                <a href="/players/{{$users->accounts->dota_id}}/achievements/create"
                    class="flex w-8/12 items-center px-2 py-2 font-semibold leading-loose
                    whitespace-no-wrap border border-indigo-800 rounded-lg shadow-md btn-indigo
                     hover:border-transparent text-md"><i class="mr-1 material-icons">
                    add</i>New Achievement</a>
                @endif
                <edit-achievement></edit-achievement>

            </table>
            <div class="p-2 mt-4 -mb-1">
                {{ $achievements->links() }}

            </div>
        </div>

    </div>
    @if(Auth::user()->accounts->dota_id == $users->accounts->dota_id)
        @if($achievements->total() != 0)
        <div class="mt-16 ml-20">
            <a href="/players/{{$users->accounts->dota_id}}/achievements/create" class="flex items-center mt-2 px-2 py-2 font-semibold leading-loose whitespace-no-wrap border border-indigo-800 rounded-lg shadow-md btn-indigo hover:border-transparent text-md"><i class="mr-1 material-icons">
                                    add</i>New Achievement</a>
        </div>
        @endif
    @endif

</div>
</div>
@endsection
