<template>
    <Transition name="shrink">
        <slot />
    </Transition>
</template>
<style scoped>
.shrink-enter-active,
.shrink-leave-active {
    transition: opacity 0.1s;
}

.shrink-enter,
.shrink-leave-to {
    opacity: 0;
}
</style>