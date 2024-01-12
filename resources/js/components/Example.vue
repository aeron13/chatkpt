<template>
    <h1 class="bg-red-300 mt-[100px]">example</h1>
    <button @click="count++">{{ count }}</button>
</template>

<script>
export default {
    name: 'Example',
    data() {
        return {
          count: 0
        }
    }
}
</script>