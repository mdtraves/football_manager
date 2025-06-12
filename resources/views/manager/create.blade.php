<x-app-layout>
<div>
    Create Your Manager Profile:

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('manager.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="middle_names" :value="__('Middle Names (Optional)')" />
                            <x-text-input id="middle_names" class="block mt-1 w-full" type="text" name="middle_names" :value="old('middle_names')" />
                            <x-input-error :messages="$errors->get('middle_names')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="sur_name" :value="__('Surname')" />
                            <x-text-input id="sur_name" class="block mt-1 w-full" type="text" name="sur_name" :value="old('sur_name')" required />
                            <x-input-error :messages="$errors->get('sur_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="height" :value="__('Height (cm) (Optional)')" />
                            <x-text-input id="height" class="block mt-1 w-full" type="number" name="height" :value="old('height')" />
                            <x-input-error :messages="$errors->get('height')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="weight" :value="__('Weight (kg) (Optional)')" />
                            <x-text-input id="weight" class="block mt-1 w-full" type="number" name="weight" :value="old('weight')" />
                            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="country_id" :value="__('Nationality')" />
                            <select id="country_id" name="country_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select your country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Create Manager') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
