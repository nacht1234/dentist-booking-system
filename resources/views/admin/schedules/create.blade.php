{{-- resources/views/admin/schedules/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Schedule</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf

            <div>
                <label for="dentist_id" class="block text-sm font-medium text-gray-700">Dentist</label>
                <select id="dentist_id" name="dentist_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Dentist</option>
                    @foreach ($dentists as $dentist)
                        <option value="{{ $dentist->id }}" {{ old('dentist_id') == $dentist->id ? 'selected' : '' }}>
                            {{ $dentist->name }} ({{ $dentist->specialization }})
                        </option>
                    @endforeach
                </select>
                @error('dentist_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input id="date" name="date" type="date" value="{{ old('date') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input id="start_time" name="start_time" type="time" value="{{ old('start_time') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('start_time') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                <input id="end_time" name="end_time" type="time" value="{{ old('end_time') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('end_time') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.schedules.index') }}" class="mr-4 inline-block px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Add Schedule</button>
            </div>
        </form>
    </div>
</x-app-layout>
