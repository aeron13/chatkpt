<x-app-layout>
    <div x-data="dashboard">
        <div class="mx-[20px] lg:mx-[35px] grid lg:grid-cols-12 pt-[162px]">
            @include('partials/sidebar')
            @include('partials/conversations-list')
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">

    document.addEventListener('alpine:init', () => {

        Alpine.data('dashboard', () => ({
            async init() {
                await this.$store.api.setConversations()
                this.$store.api.loading = false
            }
        }))

    })
</script>