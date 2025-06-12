<x-app-layout>
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teams') }}
        </h2>
        @section('title', 'Teams - Footy Manager')
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="p-6 bg-white gap-2 grid overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ($teams as $team)
                <a href="{{ route('teams.show', $team->id) }}" class="grid grid-cols-4 {{ $team->injured ? 'bg-red-300' : '' }}">
                    <p>{{ $team->name }} </p>
                    <p>{{ $team->manager_name }} </p>
                    <p>{{ $team->overall_rating }} </p>
                    <p>{{ $team->country->name }} </p>

                </a>
            @endforeach
        </div>
    </div>
</div>

</x-app-layout>
