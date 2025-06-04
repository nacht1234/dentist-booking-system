<x-app-layout>
    <x-slot name="header">My Bookings</x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            @if ($bookings->count())
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Dentist</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Time</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="border-t">
                                <td class="py-2">{{ $booking->dentist->name }}</td>
                                <td>{{ $booking->schedule->date }}</td>
                                <td>{{ $booking->schedule->time }}</td>
                                <td class="{{ $booking->status === 'confirmed' ? 'text-green-600' : 'text-yellow-600' }}">
                                    {{ ucfirst($booking->status) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No bookings found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
