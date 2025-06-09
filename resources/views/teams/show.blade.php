<x-app-layout>
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div>
<p>Team: {{ $team->name }}</p>
<p>Manager: {{ $team->manager->first_name }} {{ $team->manager->sur_name }}</p>
<p>Rating: {{ $team->overall_rating }}</p>
<p>Country: {{ $team->country->name ?? 'N/A' }}</p>
<p>League: {{ $team->league->name ?? 'N/A' }}</p>

<p class="my-6">Squadlist:</p>

@foreach ($team->players as $player)
 <a href="{{ @route('players.show', $player->id) }}" class="grid grid-cols-4 {{ $player->injured ? 'bg-red-300' : '' }}">
            <p>{{ $player->first_name }} {{ $player->sur_name }} - ({{ $player->position }})</p>
            <p>{{ $player->team->name }} ({{ $player->country->name }})</p>
            <p>{{ $player->overall_rating }}</p>
            <p>£{{ number_format($player->value) }}</p>
        </a>
@endforeach

</div>
</x-app-layout>

