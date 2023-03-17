<script setup>
    const props = defineProps({
        image:{
            type:String
        }
    })
</script>

<template>
    <div>
        <img v-if="image" class="w-12 h-12 ring-4 ring-brown-3 rounded-full"  :src="image"/>
        <IconsUser v-else class="w-12"/>
    </div>
</template>