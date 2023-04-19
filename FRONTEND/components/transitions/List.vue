<template>
    <TransitionGroup tag="div" name="list">
        <slot />
    </TransitionGroup>
</template>
<style>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(90px);
}
</style>
