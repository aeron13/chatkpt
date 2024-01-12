<template>
    <div class="relative" v-click-outside="open = false">
        <div @click="open = ! open">
            <button class="inline-flex items-center px-3 py-2 text-sm leading-4 text-[16px] rounded-md border border-light " :class="{ 'border-transparent': open }">
                <slot name="trigger"></slot>
                <div class="ms-1">
                    <svg class="fill-light h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </div>

        <div 
            v-show="open"
            :class="`absolute z-50 mt-2 w-${ width } rounded-md shadow-lg ${ alignmentClasses } bg-light text-black`"
            @click="open = false"
        >
            <div :class="`rounded-md ring-1 ring-black ring-opacity-5 ${ contentClasses }`">
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'Dropdown',
        props: {
            align: {
                default: 'right'
            },
            width: {
                default: 48
            },
            contentClasses: {
                default: 'py-1 bg-white dark:bg-gray-700'
            }
        },
        data() {
            return {
                open: false,
            }
        },
        computed: {
            alignmentClasses() {
                switch (this.align) {
                    case 'left':
                        return 'ltr:origin-top-left rtl:origin-top-right start-0'
                    case 'top':
                        return 'origin-top'
                    case 'right':
                        return ''
                    default:
                        return 'ltr:origin-top-right rtl:origin-top-left end-0'
                }
            },
        }
    }

</script>