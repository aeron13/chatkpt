@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full text-lg font-bold border border-[#C9C9C9] dark:border-none px-[16px] py-[12px] focus:outline-none rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px] placeholder:font-light']) !!}>
