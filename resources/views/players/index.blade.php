<x-app-layout>
<div>
    Players:

    @foreach ($players as $player)
        <div class="grid grid-cols-4 {{ $player->injured ? 'bg-red-300' : '' }}">
            <p>{{ $player->first_name }} {{ $player->sur_name }} - ({{ $player->position }})</p>
            <p>{{ $player->team->name }} ({{ $player->country->name }})</p>
            <p>{{ $player->overall_rating }}</p>
            <p>£{{ number_format($player->value) }}</p>
        </div>
    @endforeach
</div>
</x-app-layout>
