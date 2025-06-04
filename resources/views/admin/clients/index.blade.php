<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registered Clients</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">

            @if($clients->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($clients as $client)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $client->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $client->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $client->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $clients->links() }}
                </div>
            @else
                <p class="text-gray-500">No registered clients found.</p>
            @endif

        </div>
    </div>
</x-app-layout>
