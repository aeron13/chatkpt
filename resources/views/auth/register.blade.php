<x-guest-layout>
<div class="w-full h-screen flex justify-center items-center">
    <x-form-box :title="'Register'">
        <form method="POST" action="{{ route('register') }}" class="mt-[56px] mb-[67px] mx-[30px]">
            @csrf

            <!-- Name -->
            <x-form-block>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" :placeholder="'Name'" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </x-form-block>

            <!-- Email Address -->
            <x-form-block class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" :placeholder="'Email'" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </x-form-block>

            <!-- Password -->
            <x-form-block class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                :placeholder="'Password'"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </x-form-block>

            <!-- Confirm Password -->
            <x-form-block class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                :placeholder="'Confirm password'"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </x-form-block>

            <div class="flex items-center mt-4">
                <a class="underline text-sm  text-light" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
            <x-primary-button class="mt-7">
            {{ __('Register') }}
            </x-primary-button>
        </form>
    </x-form-box>
</div>
</x-guest-layout>
