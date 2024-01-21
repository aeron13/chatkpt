<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 border dark:border-light hover:border-green rounded-full font-semibold dark:text-light focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
