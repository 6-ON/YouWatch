<script setup>
    const props = defineProps({
        image:{
            type:String,
            required:true
        },
        size:{
            default:'w-12 h-12',
            type:String
        }
    })
</script>

<template>
    <div class="min-w-fit min-h-fit">
        <img :class="size" class="ring-4 ring-brown-3 rounded-full"  :src="image"/>
    </div>
</template>