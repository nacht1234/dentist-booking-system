<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Confirmed Bookings</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            @if ($bookings->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Client</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Dentist</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Date</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Time</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4">{{ $booking->user->name }}</td>
                                <td class="px-6 py-4">{{ $booking->dentist->name }}</td>
                                <td class="px-6 py-4">{{ $booking->schedule->date }}</td>
                                <td class="px-6 py-4">{{ $booking->schedule->time }}</td>
                                <td class="px-6 py-4 text-green-600 font-semibold">{{ ucfirst($booking->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $bookings->links() }}
                </div>
            @else
                <p class="text-gray-500">No confirmed bookings yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
