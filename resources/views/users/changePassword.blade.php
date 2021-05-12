<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center">
            <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="post" action="{{ route('update_password', ['user' => $user->id]) }}">
                        @csrf

                        <!-- New Password -->
                        <div>
                            <x-label for="new_password" :value="__('New Password')" />

                            <x-input id="new_password" class="block mt-1 w-full" type="password" name="password" required autofocus />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label for="confirm_password" :value="__('Confirm Password')" />

                            <x-input id="confirm_password" class="block mt-1 w-full" type="password" name="password_confirmation" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
