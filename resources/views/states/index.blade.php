<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center">
            <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('States') }}
            </h2>
            <a href="{{ route('states.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Add State') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form action="{{ route('states.index') }}" method="GET" role="search">

                        <div class="input-group">
                            <x-input class="block mb-1 w-52" type="text" name="search" placeholder="Search" :value="$search_term" />
                        </div>
                    </form>

                    <table class="min-w-full divide-y divide-gray-100 shadow-sm border-gray-200 border">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Name</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Country</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($states as $state)
                                <tr>
                                    <td class="px-3 py-2 whitespace-no-wrap">
                                        <a href="{{ route('states.edit', ['state' => $state->id]) }}" class="underline text-gray-600 hover:text-gray-900">
                                        {{ $state->name }}
                                    </td>
                                    <td class="px-3 py-2 whitespace-no-wrap">{{ $state->country->name }}</td>
                                    <td class="px-3 py-2 whitespace-no-wrap flex flex-row">
                                        <form method="POST" action="{{ route('states.destroy', ['state' => $state->id]) }}">
                                            @csrf
                                            @method("DELETE")

                                            <div class="items-center">
                                                <x-button class="ml-3">
                                                    {{ __('Delete') }}
                                                </x-button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
