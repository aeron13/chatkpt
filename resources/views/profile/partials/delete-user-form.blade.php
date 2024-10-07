<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-light">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-light">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-buttons.danger
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-buttons.danger>

    <x-ui.modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" onOpen="" onClose="" focusable>
        <x-wrappers.form class="" title="Are you sure?">
            <form method="post" action="{{ route('profile.destroy') }}" class="pb-12 pt-6">
                @csrf
                @method('delete')

                <p class="mt-1 text-sm text-gray-600 dark:text-light">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <x-wrappers.form-field class="mt-6">
                    <x-input.label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-input.text
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                    />

                    <x-input.error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </x-wrappers.form-field>

                <div class="mt-6 flex flex-col-reverse lg:flex-row flex-wrap gap-10 lg:gap-3 justify-end">
                    <x-buttons.secondary x-on:click="$dispatch('close')" class="w-fit">
                        {{ __('Cancel') }}
                    </x-buttons.secondary>

                    <x-buttons.primary>
                        {{ __('Delete Account') }}
                    </x-buttons.primary>
                </div>
            </form>
        </x-wrappers.form>
    </x-ui.modal>
</section>
