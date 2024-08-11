<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="#">
                        @csrf
                        <div>
                            <label for="Name" class="text-lg font-sm">Name</label>
                            <div class="my-2">
                                <input type="text" class="w-1/2 border-gray-300 rounded-lg shadow-sm">
                            </div>
                            <div class="my-2">
                                <button class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
