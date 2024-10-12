<div id="scrollbar" x-init="createScrollbar()" class="hidden lg:block fixed w-[4px] rounded bg-[#252525] right-[35px]" style="height: calc(100vh - 170px)">
    <div x-ref="indicator" class="scroll-indicator h-[60px] w-full bg-[#A9A9A9] rounded absolute"></div>
</div>

<script type="text/javascript">

    const createScrollbar = () => {
        const container = document.querySelector('.conversation-container')
        const scrollbar = document.querySelector('#scrollbar')
        const indicator = scrollbar.querySelector('.scroll-indicator')
        
        container.addEventListener('scroll', () => {
            const scrollY = container.scrollTop
            const top = container.scrollTop / (container.scrollHeight - container.clientHeight) * (scrollbar.clientHeight - indicator.clientHeight);
            indicator.style.top = top + 'px'
        })
    }

</script>