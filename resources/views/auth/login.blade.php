<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="w-full h-screen flex justify-center items-center">
        <x-form-box :title="'Log in'">

            <form method="POST" action="{{ route('login') }}" class="mt-[56px] mb-[67px] mx-[30px]">
                @csrf
                <!-- Email Address -->
                <x-form-block>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </x-form-block>

                <!-- Password -->
                <x-form-block class="mt-4">
                    <x-input-label for="password" :value="__('Password')"  />
                    <x-text-input id="password"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </x-form-block>

                <div class="flex flex-wrap justify-between items-baseline mt-4">
                    <!-- Remember Me -->
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="" name="remember">
                            <span class="ms-2 text-sm text-light">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-light" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-primary-button class="mt-7">
                    {{ __('Log in') }}
                </x-primary-button>
            </form>
        </x-form-box>
    </div>
</x-guest-layout>
