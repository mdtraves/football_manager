<x-app-layout>
<div>
    Teams:

    @foreach ($teams as $team)
        <a href="{{ route('teams.show', $team->id) }}" class="grid grid-cols-4 {{ $team->injured ? 'bg-red-300' : '' }}">
            <p>{{ $team->name }} </p>
            <p>{{ $team->manager_name }} </p>
            <p>{{ $team->overall_rating }} </p>
            <p>{{ $team->country->name }} </p>

        </a>
    @endforeach
</div>
</x-app-layout>
