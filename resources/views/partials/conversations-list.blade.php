<div class="lg:col-start-4 lg:col-end-12 pb-[100px]"  x-data="hasModal" @close-modal.window="closeModal()" x-show="!$store.api.loading && $store.api.conversations.length > 0" x-transition.opacity >
    <h6 class="font-sans font-light text-lg text-light" x-text="$store.api.category.name ?? 'All conversations' "></h6>
    <template x-for="(timespan, index) in $store.api.orderedConversations" :key="index">
        <div x-show="timespan.posts.length > 0" class="mt-[28px]">
            <h6 class="font-sans lg:font-light text-sm lg:text-base text-light mb-[15px]" x-text="timespan.timespan"></h6>
            <ul class="grid lg:grid-cols-2 gap-2 lg:gap-4 mb-[40px]">
                <template x-for="post in timespan.posts" :key="post.id">
                    <a x-bind:href="post.url">
                        <li class="rounded-2xl bg-glass-1 rounded-xl py-[10px] lg:py-[16px] pl-[20px] lg:pl-[25px] pr-[10px] lg:pr-[16px] border border-[0.5px] border-[#868686] lg:h-[162px] transform hover:rotate-[-1deg] transition-transform duration-500" >
                            <div class="w-full h-full flex flex-col justify-between items-end">
                                <p class="w-full font-special text-2xl font-medium text-light mb-[20px] mt-[5px] pr-[6px] lg:m-0 lg:p-0" x-text="post.title"></p>
                                <div class="w-full flex relative gap-2">
                                    <template x-for="cat in post.categories">
                                        <div class="w-[20px] h-[20px] lg:w-[32px] lg:h-[32px] origin-top-left rotate-[-4.45deg] rounded-[5px]  transform translate-x-[-10px]" x-bind:style="`background-color: ${cat.color}`"></div>
                                    </template>
                                    <button @click="openModal" x-bind:conv="post.id" class="add-icon w-[23px] h-[23px] absolute right-0 bottom-0 transform hover:scale-[1.1] transition-transform" style="background-image: url({{ asset('icons/plus-icon.svg') }})"></button>
                                </div>
                            </div>
                        </li>
                    </a>
                </template>
            </ul>
        </div>
    </template>

    <div class="modal fixed top-0 left-0 w-full h-full z-10 bg-black bg-opacity-70 flex justify-center pt-[130px] lg:pt-[173px]" x-show="showModal" style="display: none" x-transition>
        @include('partials/update-conversation')
    </div>
</div>

<script type="text/javascript">

    document.addEventListener('alpine:init', () => {

        Alpine.data('hasModal', () => ({
            showModal: false,
            title: '',
            id: null,

            openModal(e) {
                e.preventDefault()
                this.title = e.target.parentNode.parentNode.querySelector('p').innerText
                this.id = e.target.getAttribute('conv')
                this.showModal = true
                this.$dispatch('update-id', this.id)
                this.$store.api.categoryList.length == 0 && this.$dispatch('toggle-create-form', true)
            },

            closeModal() {
                this.id = null
                this.showModal = false
                this.$dispatch('reset-data')
            },

        }))

    })
</script>