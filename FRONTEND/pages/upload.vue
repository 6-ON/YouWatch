<script setup>
definePageMeta({
    middleware: ['auth'],
})
useHead({
    title: 'Upload video',
})
const { $axios } = useNuxtApp()
const { user } = useAuth()
const videoElement = ref(null)
const { duration } = useMediaControls(videoElement)
const progress = ref({
    step: 0,
    precent: 0,
})
const { formatDuration } = useFormatter()

const file = ref(null)
const thumbnailFile = ref(null)
// use axios plugin
const ThumbnailURL = computed(() => (thumbnailFile.value ? URL.createObjectURL(thumbnailFile.value) : ''))
const videoURL = computed(() => (file.value ? URL.createObjectURL(file.value) : ''))

const videoForm = ref({
    title: '',
    description: '',
    tags: [],
})

const selectVideo = e => (file.value = e.target.files[0])

const addTag = e => {
    if (e.target.value) {
        videoForm.value.tags.push(e.target.value)
        e.target.value = ''
    }
}
const removeTag = index => {
    videoForm.value.tags.splice(index, 1)
}
const canUpload = computed(
    () => videoForm.value.title && videoForm.value.description && file.value && thumbnailFile.value
)
const UPLOAD_FOLDER = 'Youwatch'
const API_KEY = '571349964156337'
const UPLOAD_URL = 'https://api.cloudinary.com/v1_1/dgmmjsxbf/auto/upload'
async function uploadVideo() {
    // upload video to cloudinary with tracking thier progress
    try {
        progress.value.step = 1
        progress.value.pending = true
        const { signature, timestamp } = await $axios.get('/api/getSignature').then(res => {
            progress.value.step = 2
            return res.data
        })
        $axios.defaults.withCredentials = false
        const thumbnailData = new FormData()
        thumbnailData.append('api_key', API_KEY)
        thumbnailData.append('signature', signature)
        thumbnailData.append('timestamp', timestamp)
        thumbnailData.append('folder', UPLOAD_FOLDER)
        thumbnailData.append('file', thumbnailFile.value)
        // upload thumbnail and track progress
        const { secure_url: thumbnail_url } = await $axios
            .post(UPLOAD_URL, thumbnailData, {
                onUploadProgress: e => (progress.value.precent = Math.floor((e.loaded * 100) / e.total)),
            })
            .then(res => {
                progress.value.step = 3
                return res.data
            })
        // upload video and track progress
        const videoData = new FormData()
        videoData.append('api_key', API_KEY)
        videoData.append('signature', signature)
        videoData.append('timestamp', timestamp)
        videoData.append('folder', UPLOAD_FOLDER)
        videoData.append('file', file.value)
        const {
            data: { secure_url: video_url },
        } = await $axios.post(UPLOAD_URL, videoData, {
            onUploadProgress: e => (progress.value.precent = Math.floor((e.loaded * 100) / e.total)),
        })
        $axios.defaults.withCredentials = true
        // upload video to database
        await $axios.post('/api/videos', {
            ...videoForm.value,
            url: video_url,
            duration: formatDuration(duration.value),
            thumbnail_url: thumbnail_url,
        })
    } catch (error) {
        console.log(error)
    } finally {
        progress.value.step = 4
    }

    console.log({
        ...videoForm.value,
        video: file.value,
        duration: formatDuration(duration.value),
        thumb: thumbnailFile.value,
    })
}
</script>
<template>
    <ModalSpinner v-if="progress.step === 1">Preparing</ModalSpinner>
    <ModalProgress v-else-if="progress.step === 2" :value="progress.precent"> Uploading Thumbnail</ModalProgress>
    <ModalProgress v-else-if="progress.step === 3" :value="progress.precent"> Uploading Video</ModalProgress>
    <Modal v-else-if="progress.step === 4" :value="progress.precent" :closable="false">
        <!-- title slot: upload finished -->
        <template #title>Upload finished</template>
        <!-- body slot: upload finished -->
        <template #body>
            <div class="flex flex-col my-auto justify-center gap-4 items-center">
                <!-- nuxt link go to home  -->
                <NuxtLink to="/" class="bg-brown-3 text-brown-1 w-fit rounded-lg p-2 cursor-pointer flex items-center gap-2">
                    <span class="material-symbols-sharp"> home </span>
                    Go to home
                </NuxtLink>
                <!-- nuxt link go to video page  -->
                <NuxtLink :to="`/user/${user.username}` " class="bg-brown-3 text-brown-1 w-fit rounded-lg p-2 cursor-pointer flex items-center gap-2">
                    <span class="material-symbols-sharp"> video_library </span>
                    Go to my videos
                </NuxtLink>
            </div>
        </template>
    </Modal>
    <div class="grid grid-cols-1 md:grid-cols-2 bg-brown-1 text-brown-4">
        <!-- <video  :src="videoURL" controls></video> -->
        <div class="flex flex-col p-4 gap-4 items-center">
            <div v-if="ThumbnailURL" class="flex flex-col gap-2 items-center">
                <img :src="ThumbnailURL" class="w-96 aspect-video object-cover rounded-xl" />
                <label for="video-thumbnail" class="bg-brown-3 text-brown-1 w-fit rounded-lg p-2 cursor-pointer flex items-center gap-2">
                    <span class="material-symbols-sharp"> refresh </span>
                    Change thumbnail
                </label>
            </div>
            <FileDrop v-else target-id="video-thumbnail" @selected="f => (thumbnailFile = f)" class="w-96" />
            <input type="text" v-model="videoForm.title" placeholder="Title" class="form-input py-4 px-6 text-2xl" />
            <div class="self-stretch">
                <input type="text" @keydown.enter.prevent="e => addTag(e)" placeholder="tags" class="form-input py-4 px-6 text-lg" />
                <div class="flex flex-wrap gap-2 p-2 w-fit">
                    <div v-for="(tag, index) in videoForm.tags" class="flex items-center gap-2 bg-brown-3 text-brown-1 rounded-lg p-2">
                        <span class="material-symbols-sharp cursor-pointer select-none" @click="removeTag(index)"> close </span>
                        <span>{{ tag }}</span>
                    </div>
                </div>
            </div>
            <textarea
                class="resize-none form-input py-4 px-6"
                v-model="videoForm.description"
                placeholder="Description"
                cols="30"
                rows="10"
            ></textarea>
            <form @submit.prevent="uploadVideo">
                <input id="video-to-upload" type="file" accept="video/*" @change="selectVideo" hidden />
                <input id="video-thumbnail" type="file" accept="image/*" @change="e => (thumbnailFile = e.target.files[0])" hidden />
                <VideoButtonsPublish :disabled="!canUpload" />
            </form>
        </div>
        <div class="max-md:order-first px-1 md:px-4">
            <FileDrop v-if="!file" target-id="video-to-upload" @selected="f => (file = f)" />
            <div v-else class="video-preview">
                <div class="flex flex-col w-full">
                    <video ref="videoElement" :src="videoURL" class="w-full aspect-video mx-auto rounded-t-2xl" controls></video>
                    <label
                        for="video-to-upload"
                        class="bg-brown-3 text-brown-1 w-fit pb-1 pt-2 px-5 self-end rounded-b-full cursor-pointer flex items-center gap-2"
                    >
                        <span class="material-symbols-sharp"> refresh </span>
                        change video
                    </label>
                </div>
                <div class="flex flex-col border border-brown-3 w-fit pt-12 p-3 rounded-xl relative">
                    <span class="bg-brown-3 w-fit pb-2 pt-1 px-5 rounded-br-xl rounded-tl-xl absolute top-0 left-0 text-brown-1">Details</span>
                    <h6>
                        Filename : <strong>{{ file.name }}</strong>
                    </h6>
                    <h6>
                        Duration :
                        <strong>{{ formatDuration(duration) }}</strong>
                    </h6>
                    <h6>
                        Size :
                        <strong>{{ Math.floor(file.size / 1024 / 1024) }} Mb</strong>
                    </h6>
                    <h6>
                        Thumbnail filename :
                        <strong>{{ thumbnailFile?.name }} </strong>
                    </h6>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.video-preview {
    @apply flex flex-col gap-4;
}

.form-input {
    @apply w-full bg-brown-1 border-[0.1rem] placeholder:text-brown-4 border-brown-3 rounded-3xl focus:outline-none focus:border-opacity-100 border-opacity-30;
}
</style>
