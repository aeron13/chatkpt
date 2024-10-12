<form x-data="searchForm" @submit.prevent="handleSubmit" class="flex gap-1 items-stretch">
    <input 
        type="search" 
        x-model="query" 
        placeholder="search" 
        class="font-sans bg-transparent border border-dark dark:border-light text-dark dark:text-light w-full text-[14px] px-[8px] py-[3px] focus:outline-none rounded-tl-[10px] rounded-tr-[10px] rounded-bl-[10px] rounded-br-[3px] placeholder:font-light" 
        />
    <button class="w-fit bg-[#515151] pt-1 pb-2 pr-2 pl-1 rounded-[10px]">
        <svg width="20" height="13" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 14a1 1 0 0 1 1-1h12a3 3 0 0 0 3-3V6a1 1 0 1 1 2 0v4a5 5 0 0 1-5 5H4a1 1 0 0 1-1-1z" fill="#ffffff"/><path fill-rule="evenodd" clip-rule="evenodd" d="M3.293 14.707a1 1 0 0 1 0-1.414l4-4a1 1 0 0 1 1.414 1.414L5.414 14l3.293 3.293a1 1 0 1 1-1.414 1.414l-4-4z" fill="#ffffff"/></svg>
    </button>
</form>