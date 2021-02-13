<template>
    <div id="loading-screen" class="w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50" v-bind:class="{ hidden: this.loadingHidden }">
      <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0">
        <i class="fas fa-circle-notch fa-spin fa-5x"></i>
      </span>
    </div>
</template>
<script>
export default {
    name: 'LoadingComponent',
    props: {
        loadingHidden: {
            type: Boolean,
            default: true
        }
    }
}
</script>
