<x-app-layout>
    <div class="fixed w-screen h-screen bg-profile bg-no-repeat z-[-1] top-0 left-0"></div>
    <div class="mx-[15px] lg:mx-[35px] grid grid-cols-12 pt-[150px] lg:pt-0">
        <div class="lg:pt-[162px]">
            @include('partials/sidebar')
        </div>
        <div class="col-span-12 lg:col-start-4 pb-[100px] lg:pt-[162px]">
            <h6 class="font-sans font-light text-lg dark:text-light">Your profile</h6>
            <div class="py-12">
                <div class="flex flex-col gap-20 max-w-2xl">
                    <div class="bg-lightglass-1 dark:bg-glass-1 backdrop-blur-lg px-[28px] pt-[25px] pb-[28px] rounded-[16px] border-[0.5px] border-[#C9C9C9] dark:border-[#767676] shadow-xl">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="bg-lightglass-1 dark:bg-glass-1 backdrop-blur-lg px-[28px] pt-[25px] pb-[28px] rounded-[16px] border-[0.5px] border-[#C9C9C9] dark:border-[#767676] shadow-xl">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>   

        </div>
    </div>

    
</x-app-layout>
