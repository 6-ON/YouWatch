<script lang="ts" setup>
const props = defineProps<{
    filled: Boolean
}>()
</script>

<template>
    <svg v-if="filled" xmlns="http://www.w3.org/2000/svg" height="32" fill="currentColor" viewBox="0 96 960 960" width="32">
        <path
            d="M721 936H254V424l278-288 33 26q11 8 14.5 18t3.5 23v10l-45 211h322q23 0 41.5 18.5T920 484v82q0 11-2.5 25.5T910 617L794 885q-9 21-29.5 36T721 936ZM194 424v512H80V424h114Z" />
    </svg>
    <svg v-else xmlns="http://www.w3.org/2000/svg" height="32" width="32" fill="currentColor" viewBox="0 96 960 960">
        <path
            d="M716 936H272V424l278-288 39 31q6 5 9 14t3 22v10l-45 211h299q24 0 42 18t18 42v81.839q0 7.161 1.5 14.661T915 595L789 885q-8.878 21.25-29.595 36.125Q738.689 936 716 936Zm-384-60h397l126-299v-93H482l53-249-203 214v427Zm0-427v427-427Zm-60-25v60H139v392h133v60H79V424h193Z" />
    </svg>
</template>