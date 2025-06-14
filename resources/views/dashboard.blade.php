<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @section('title', 'My Club Dashboard - Footy Manager')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-6 grid">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>These are the teams:</h2>
                    <div class="flex flex-col">
                        @foreach ($teams->groupBy('league.id') as $leagueId => $teamsInLeague)
                            <h3 class="text-xl">{{ $teamsInLeague->first()->league->name }}</h3>
                            <ul class="mb-4 grid">
                                @foreach ($teamsInLeague as $team)
                                    <a href="/teams/{{ $team->id }}" class="{{ $team->overall_rating > 90 ? "text-red-400" : "" }}" >{{ $team->name }} rating: {{ $team->overall_rating  }}</a>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
