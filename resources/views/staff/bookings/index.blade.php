<x-app-layout>
    <x-slot name="header">Pending Bookings</x-slot>

    <div class="max-w-6xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            @if (session('success'))
                <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
            @endif

            @if ($bookings->count())
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Client</th>
                            <th class="text-left">Dentist</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Time</th>
                            <th class="text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="border-t">
                                <td class="py-2">{{ $booking->user->name }}</td>
                                <td>{{ $booking->dentist->name }}</td>
                                <td>{{ $booking->schedule->date }}</td>
                                <td>{{ $booking->schedule->time }}</td>
                                <td>
                                    <form method="POST" action="{{ route('staff.bookings.confirm', $booking) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-600 text-black px-3 py-1 rounded hover:bg-green-700">
                                            Confirm
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No pending bookings.</p>
            @endif
        </div>
    </div>
</x-app-layout>
