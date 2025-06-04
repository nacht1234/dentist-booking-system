<x-app-layout>
    <x-slot name="header">Book an Appointment</x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <form action="{{ route('client.bookings.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Available Schedules by Dentist</label>
                <select name="schedule_id" id="schedule_id" class="w-full border rounded" required>
                    <option value="" disabled selected>Select a schedule</option>
                    @foreach ($dentists as $dentist)
                        @if ($dentist->availableSchedules->count() > 0)
                            <optgroup label="{{ $dentist->name }}">
                                @foreach ($dentist->availableSchedules as $schedule)
                                    <option value="{{ $schedule->id }}">
                                        {{ $schedule->date->format('M d, Y') }} 
                                        from {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} 
                                        to {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endif
                    @endforeach
                </select>
                @error('schedule_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">
                    Submit Booking
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
