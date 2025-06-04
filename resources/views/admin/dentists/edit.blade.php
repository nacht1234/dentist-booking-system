{{-- resources/views/admin/dentists/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Dentist</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('admin.dentists.update', $dentist) }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $dentist->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $dentist->email) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
                <input id="specialization" name="specialization" type="text" value="{{ old('specialization', $dentist->specialization) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('specialization') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone (optional)</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $dentist->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.dentists.index') }}" class="mr-4 inline-block px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Update Dentist</button>
            </div>
        </form>
    </div>
</x-app-layout>
