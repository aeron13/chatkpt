<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-black rounded-[30px] font-semibold text-light text-[19px] px-[30px] pt-[13px] pb-[15px] flex items-center']) }}>
    {{ $slot }}
</button>
