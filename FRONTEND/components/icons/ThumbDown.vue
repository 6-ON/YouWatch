<script lang="ts" setup>
const props = defineProps<{
    filled: Boolean
}>()
</script>

<template>
    <svg v-if="filled" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="32"  viewBox="0 96 960 960" width="32">
        <path
            d="M239 216h467v512l-278 288-33-26q-11-8-14.5-18t-3.5-23v-10l45-211H100q-23 0-41.5-18.5T40 668v-82q0-11 2.5-25.5T50 535l116-268q9-21 29.5-36t43.5-15Zm527 512V216h114v512H766Z" />
    </svg>
    <svg v-else xmlns="http://www.w3.org/2000/svg" height="32" fill="currentColor" viewBox="0 96 960 960" width="32">
        <path
            d="M242 216h444v512l-278 288-39-31q-6-5-9-14t-3-22v-10l45-211H103q-24 0-42-18t-18-42v-81.839Q43 579 41.5 571.5T43 557l126-290q8.878-21.25 29.595-36.125Q219.311 216 242 216Zm384 60H229L103 575v93h373l-53 249 203-214V276Zm0 427V276v427Zm60 25v-60h133V276H686v-60h193v512H686Z" />
    </svg>
</template>