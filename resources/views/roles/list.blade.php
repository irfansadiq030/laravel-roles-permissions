<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-message></x-message>

            <table class="w-full bg-gray-50 rounded-lg shadow-sm mb-3 py-8 text-center">
                <thead>
                    <tr class="border-b">
                        <th class="py-3">#</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center pt-5">

                    @if ($roles->isNotEmpty())

                        @foreach ($roles as $index => $role)
                            <tr class="border-b">
                                <td class="py-4" width="100">{{ $index }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', $role->id) }}"
                                        class="bg-slate-700 text-sm rounded-md text-white px-5 py-2 mr-3 hover:bg-slate-600">Edit</a>

                                    <a onclick="deletePermission({{ $role->id }})" href="#"
                                        class="bg-red-600 text-sm rounded-md text-white px-5 py-2 hover:bg-red-500">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    @endif

                </tbody>
            </table>
            {{ $roles->links() }}
        </div>
    </div>

    <x-slot name="script">
        <script>
            function deletePermission(id) {

                if (confirm("Are you sure you want to delete this permission")) {

                    $.ajax({
                        url: '{{ route('permissions.destroy') }}',
                        type: "delete",
                        data: {
                            id
                        },
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                window.location.href = '{{ route('permissions.index') }}'
                            }
                        }
                    })
                }
            }
        </script>
    </x-slot>

</x-app-layout>
