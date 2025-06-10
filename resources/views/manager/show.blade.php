<x-app-layout>
<div>
  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Manager Profile') }}
        </h2>
    </x-slot>
    <div class="p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
        @endif
        @if (session('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('warning') }}</span>
            </div>
        @endif

        <h3 class="text-lg font-bold mb-4">{{ $manager->first_name }} {{ $manager->middle_names }} {{ $manager->sur_name }}</h3>

        <p><strong>Nationality:</strong> {{ $manager->country->name ?? 'N/A' }}</p>
        <p><strong>Date of Birth:</strong> {{ $manager->date_of_birth }}</p>
        <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($manager->date_of_birth)->age }}</p>
        <p><strong>Height:</strong> {{ $manager->height ?? 'N/A' }} cm</p>
        <p><strong>Weight:</strong> {{ $manager->weight ?? 'N/A' }} kg</p>
        <p><strong>Weekly Wage:</strong> ${{ number_format($manager->weekly_wage) }}</p>
        <p><strong>Contract End:</strong> {{ $manager->contract_end_date }}</p>

        <h4 class="font-semibold mt-6">Current Team:</h4>
        @if ($manager->team)
            <p>Managing: <a href="{{ route('teams.show', $manager->team->id) }}" class="text-blue-600 hover:underline">{{ $manager->team->name }}</a></p>
        @else
            <p class="text-red-600 font-bold">Currently unemployed.</p>
            <div class="mt-4">
                <a href="{{ route('manager.choose_team') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Choose a Team to Manage') }}
                </a>
            </div>
        @endif

        <div class="mt-6">
            {{-- Future: Add an edit button here --}}
            {{-- <x-primary-button>Edit Profile</x-primary-button> --}}
        </div>
    </div>

</div>
</x-app-layout>
