<div class="hidden lg:block col-span-3 fixed" x-show="!$store.api.loading && $store.api.categoryList.length > 0" x-transition.opacity>
    <h6 class="font-sans font-light text-lg dark:text-light mb-[28px]">Categories</h6>
    @include('partials/categories-list')
</div>