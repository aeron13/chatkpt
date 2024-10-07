<x-guest-layout>
<div class="w-full h-screen flex justify-center lg:items-center pt-[173px] lg:pt-0">
    <x-wrappers.form :title="'Register'" class="">
        <form method="POST" action="{{ route('register') }}" class="mt-[56px] mb-[83px] lg:mb-[67px] lg:mx-[30px]">
            @csrf

            <!-- Name -->
            <x-wrappers.form-field>
                <x-input.label for="name" :value="__('Name')" />
                <x-input.text id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" :placeholder="'Name'" required autofocus autocomplete="name" />
                <x-input.error :messages="$errors->get('name')" class="mt-2" />
            </x-wrappers.form-field>

            <!-- Email Address -->
            <x-wrappers.form-field class="mt-4">
                <x-input.label for="email" :value="__('Email')" />
                <x-input.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" :placeholder="'Email'" required autocomplete="username" />
                <x-input.error :messages="$errors->get('email')" class="mt-2" />
            </x-wrappers.form-field>

            <!-- Password -->
            <x-wrappers.form-field class="mt-4">
                <x-input.label for="password" :value="__('Password')" />

                <x-input.text id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                :placeholder="'Password'"
                                required autocomplete="new-password" />

                <x-input.error :messages="$errors->get('password')" class="mt-2" />
            </x-wrappers.form-field>

            <!-- Confirm Password -->
            <x-wrappers.form-field class="mt-4">
                <x-input.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input.text id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                :placeholder="'Confirm password'"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input.error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </x-wrappers.form-field>

            <div class="flex items-center mt-4">
                <a class="underline text-sm  text-light" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
            <x-buttons.primary class="mt-[51px] lg:mt-7">
            {{ __('Register') }}
            </x-buttons.primary>
        </form>
    </x-wrappers.form>
</div>
</x-guest-layout>
