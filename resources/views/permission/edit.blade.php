<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions / Edit') }}
            </h2>
            <a href="{{ route('permissions.index') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        <div>
                            <label for="Name" class="text-lg font-sm">Name</label>
                            <div class="my-2">
                                <input value="{{ old('name', $permission->name) }}" name="name" type="text" class="w-1/2 border-gray-300 rounded-lg shadow-sm">

                                {{-- Error Msg --}}
                                @error('name')
                                    <p class="text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-2">
                                <button type="submit"
                                    class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
