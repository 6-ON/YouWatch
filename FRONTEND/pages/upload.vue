<script setup>
import axios from '~~/plugins/axios';

definePageMeta({
    middleware: ['auth'],
})

// TODO: check file Type
const file = ref(null)
const thumbnailFile = ref(null)

const progress = ref(0)
// use axios plugin

const ThumbnailURL = computed(()=>{
    if (thumbnailFile.value) {
        return URL.createObjectURL(thumbnailFile.value)
    }
})
const videoURL = computed(() => {
    if (file.value) {
        return URL.createObjectURL(file.value)
    }
})


</script>
<template>
    <div class="grid grid-cols-1 md:grid-cols-2 bg-brown-1 text-brown-4">
        <!-- <video  :src="videoURL" controls></video> -->
        <div class="flex flex-col p-4 gap-4  items-center">
            <div v-if="ThumbnailURL" class="flex flex-col gap-2 items-center">
                <img :src="ThumbnailURL" class="w-96 aspect-video object-cover rounded-xl">
                <label for="video-thumbnail"
                        class="bg-brown-3 text-brown-1 w-fit  rounded-lg p-2 cursor-pointer flex items-center gap-2 ">
                        <span class="material-symbols-sharp">
                            refresh
                        </span>
                        Change thumbnail
                    </label>
            </div>
            <FileDrop v-else target-id="video-thumbnail" @selected="(f)=> thumbnailFile = f" class="w-96" />
            <input type="text" placeholder="Title" class="form-input py-4 px-6 text-2xl">
            <textarea class="resize-none form-input py-4 px-6" placeholder="Description" cols="30" rows="10"></textarea>
            <form @submit.prevent="uploadVideo">
                <input id="video-to-upload" type="file" @change="(e)=> file = e.target.files[0]" hidden>
                <input id="video-thumbnail" type="file" @change="(e)=> thumbnailFile = e.target.files[0]" hidden>
                <VideoButtonsPublish/>
            </form>
        </div>
        <div class="max-md:order-first px-1 md:px-4">
            <FileDrop v-if="!file" target-id="video-to-upload" @selected="(f) => file = f" />
            <div v-else class="video-preview">
                <div class="flex flex-col w-full">
                    <video :src="videoURL" class="w-full aspect-video mx-auto rounded-t-2xl" controls></video>
                    <label for="video-to-upload"
                        class="bg-brown-3 text-brown-1 w-fit pb-1 pt-2 px-5 self-end rounded-b-full cursor-pointer flex items-center gap-2 ">
                        <span class="material-symbols-sharp">
                            refresh
                        </span>
                        change video
                    </label>
                </div>
                <div class="flex flex-col border border-brown-3 w-fit pt-12 p-3 rounded-xl relative">
                    <span
                        class="bg-brown-3 w-fit pb-2 pt-1 px-5 rounded-br-xl rounded-tl-xl absolute top-0 left-0 text-brown-1 ">Details</span>
                    <h6>Filename : <strong>{{ file.name }}</strong> </h6>
                    <h6>Size : <strong>{{ Math.floor(file.size / 1024 / 1024) }} Mb</strong></h6>
                    <h6>Thumbnail filename : <strong>{{ thumbnailFile?.name }} </strong></h6>
                </div>
            </div>
        </div>


    </div>
</template>

<style scoped>
.video-preview {
    @apply flex flex-col gap-4
}

.form-input {
    @apply w-full bg-brown-1 border-[0.1rem] placeholder:text-brown-4 border-brown-3 rounded-3xl focus:outline-none focus:border-opacity-100 border-opacity-30
}
</style>