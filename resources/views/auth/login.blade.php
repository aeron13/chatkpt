<x-guest-layout>
    <!-- Session Status -->
    <x-ui.auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="w-full h-screen flex justify-center lg:items-center pt-[173px] lg:pt-0">
        <x-wrappers.form :title="'Log in'" class="">

            <form method="POST" action="{{ route('login') }}" class="mt-[56px] mb-[83px] lg:mb-[67px] lg:mx-[30px]">
                @csrf
                <!-- Email Address -->
                <x-wrappers.form-field>
                    <x-input.label for="email" :value="__('Email')" />
                    <x-input.text id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input.error :messages="$errors->get('email')" class="mt-2" />
                </x-wrappers.form-field>

                <!-- Password -->
                <x-wrappers.form-field class="mt-4">
                    <x-input.label for="password" :value="__('Password')"  />
                    <x-input.text id="password"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input.error :messages="$errors->get('password')" class="mt-2" />
                </x-wrappers.form-field>

                <div class="flex flex-col lg:flex-row flex-wrap justify-between items-baseline mt-4">
                    <!-- Remember Me -->
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="" name="remember">
                            <span class="ms-2 text-sm dark:text-light">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="mt-6 lg:mt-0 underline text-sm dark:text-light" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-buttons.primary class="mt-[51px] lg:mt-7">
                    {{ __('Log in') }}
                </x-buttons.primary>
            </form>
        </x-wrappers.form>
    </div>
</x-guest-layout>
