<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center">
            <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Add new user</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form action="{{ route('users.index') }}" method="GET" role="search">

                        <div class="input-group">
                            <x-input class="block mb-1 w-52" type="text" name="search" placeholder="Search" :value="$search_term" />
                        </div>
                    </form>

                    <table class="min-w-full divide-y divide-gray-100 shadow-sm border-gray-200 border">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Name</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Username</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Email</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Created At</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Updated At</th>
                                <th class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-3 py-2 whitespace-no-wrap">
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="underline text-gray-600 hover:text-gray-900">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </td>
                                    <td class="px-3 py-2 whitespace-no-wrap">{{ $user->username }}</td>
                                    <td class="px-3 py-2 whitespace-no-wrap">{{ $user->email }}</td>
                                    <td class="px-3 py-2 whitespace-no-wrap">{{ $user->created_at }}</td>
                                    <td class="px-3 py-2 whitespace-no-wrap">{{ $user->updated_at }}</td>
                                    <td class="px-3 py-2 whitespace-no-wrap flex flex-row">
                                        <div class="flex-1 items-center">
                                            <a href="{{ route('change_password', ['user' => $user->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                {{ __('Change Password') }}
                                            </a>
                                        </div>
                                        <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
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
