<script lang="ts" setup>
const props = defineProps({
    value: {
        type: Number,
        default: 0,
    },
})
const radialProgress = ref<HTMLDivElement>()
watch(
    () => props.value,
    newValue => {
        if (radialProgress.value) {
            radialProgress.value.style.background = `conic-gradient(#594545 ${newValue * 3.6}deg, #ededed 0deg)`
        }
    },
    { immediate: true }
)
</script>

<template>
    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50">
        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-brown-1 w-96 h-96 rounded-lg z-50">
            <div class="flex flex-col justify-around items-center h-full">
                <div ref="radialProgress" class="circular-progress">
                    <span class="progress-value">{{ value }}%</span>
                </div>
                <span class="text-brown-4 text-2xl">
                    <slot />
                </span>
            </div>
        </div>
    </div>
</template>

<style scoped>
.circular-progress {
    position: relative;
    height: 250px;
    width: 250px;
    border-radius: 50%;
    background: conic-gradient(#594545 360deg, #ededed 0deg);
    display: flex;
    align-items: center;
    justify-content: center;
}
.circular-progress::before {
    content: '';
    position: absolute;
    height: 210px;
    width: 210px;
    border-radius: 50%;
    @apply bg-white;
}
.progress-value {
    position: relative;
    font-size: 40px;
    font-weight: 600;
    @apply text-brown-4;
}
</style>
