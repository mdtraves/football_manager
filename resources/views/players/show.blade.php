<x-app-layout>
<div>
    Player:

    @foreach ($player as $player)
        <a href="{{ @route('players.show', $player->id) }}" class="grid grid-cols-4 {{ $player->injured ? 'bg-red-300' : '' }}">
            <p>{{ $player->first_name }} {{ $player->sur_name }} - ({{ $player->position }})</p>
            <p>{{ $player->team->name }} ({{ $player->country->name }})</p>
            <p>{{ $player->overall_rating }}</p>
            <p>£{{ number_format($player->value) }}</p>
        </a>
    @endforeach
</div>
</x-app-layout>
