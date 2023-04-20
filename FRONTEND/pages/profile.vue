<script lang="ts" setup>
definePageMeta({
    layout: 'fixed-sidebar',
    middleware: 'auth',
})

const { user } = useAuth()
const UPLOAD_FOLDER = 'Youwatch'
const API_KEY = '571349964156337'
const UPLOAD_URL = 'https://api.cloudinary.com/v1_1/dgmmjsxbf/auto/upload'

const { $axios } = useNuxtApp()
const editForm = ref<TEdit>({
    image: null,
    name: user.value?.name ?? '',
    email: user.value?.email ?? '',
    password: '',
})
const imageURL = computed(() => (editForm.value.image ? URL.createObjectURL(editForm.value.image) : null))
const updating = ref(false)
const changes = computed(() => {
    if (!user.value) return
    // get changes between original data and edit form
    return Object.keys(originalData.value).reduce<TEdit | any>((changes: TEdit, key) => {
        if (originalData.value[key] !== editForm.value[key]) {
            changes[key] = editForm.value[key]
        }
        return changes
    }, null)
})

const originalData = computed<TEdit>(() => {
    if (!user.value) return {}
    const { name, email } = user.value
    return { name, email, password: '', image: null }
})

async function uploadImage() {
    if (!editForm.value.image) throw new Error('No image selected')
    const {
        data: { signature, timestamp },
    } = await $axios.get('/api/getSignature')
    const formData = new FormData()
    formData.append('file', editForm.value.image)
    formData.append('signature', signature)
    formData.append('api_key', API_KEY)
    formData.append('folder', UPLOAD_FOLDER)
    formData.append('timestamp', timestamp)
    return await $axios.post(UPLOAD_URL, formData)
}

async function updateProfile() {
	if (!changes.value) return
	updating.value = true
	try {
		if (changes.value.image) {
			const { data } = await uploadImage()
			changes.value.image = data.secure_url
		}
		await $axios.put('/api/user', changes.value)

		$toast.success('Profile updated successfully')
	} catch (error) {
		$toast.error(error.message)
	} finally {
		updating.value = false
	}
}
</script>

<template>
    <ClientOnly>
        <div>
            <div class="mx-auto mt-4 w-fit relative">
                <UserAvatar :image="imageURL ?? user?.image" size="w-32 h-32 md:w-48 md:h-48" />
                <label
                    class="absolute bottom-0 right-0 w-10 h-10 bg-brown-4 text-brown-1 p-2 rounded-full peer-disabled:bg-brown-1"
                >
                    <input
                        type="file"
                        hidden
                        :disabled="updating"
                        accept="image/*"
                        @change="(e:Event) => (editForm.image = e?.target?.files[0])"
                    />
                    <span class="material-symbols-sharp"> edit </span>
                </label>
            </div>

            <div class="w-fit mx-auto font-Montserrat text-center text-brown-4 mt-4">
                <h1 class="font-bold">{{ user?.name }}</h1>
                <h2 class="text-gray-600">@{{ user?.username }}</h2>
            </div>
            <form class="flex flex-col items-center p-4 gap-6" @submit.prevent="updateProfile">
                <input
                    :disabled="updating"
                    placeholder="Name"
                    v-model="editForm.name"
                    type="text"
                    class="input-profile"
                />
                <input
                    :disabled="updating"
                    placeholder="Name"
                    v-model="editForm.email"
                    type="email"
                    class="input-profile"
                />
                <input
                    :disabled="updating"
                    placeholder="password(unchanged)"
                    v-model="editForm.password"
                    type="password"
                    class="input-profile"
                />
                <button :disabled="!changes || updating" class="btn-save">Save</button>
            </form>
        </div>
        <template #fallback>
            <div>
                <div class="rounded-full bg-brown-3 animate-pulse w-48 h-48 mx-auto"></div>
                <!-- username -->
                <div class="rounded-md bg-brown-3 animate-pulse w-32 h-6 mx-auto mt-4"></div>
                <div class="rounded-md bg-brown-3 animate-pulse w-48 h-6 mx-auto mt-4"></div>
                <div class="rounded-md bg-brown-3 animate-pulse w-96 h-14 mx-auto mt-4"></div>
                <div class="rounded-md bg-brown-3 animate-pulse w-96 h-14 mx-auto mt-4"></div>
            </div>
        </template>
    </ClientOnly>
</template>

<style scoped>
.input-profile {
    @apply disabled:bg-gray-400 disabled:text-gray-300 w-96 p-4 font-Inter font-medium h-14 rounded-t-xl border-b-2 text-brown-4 border-brown-4 placeholder:text-brown-2 bg-black bg-opacity-5;
}
.btn-save {
    @apply p-4 font-Inter font-medium h-14 rounded-xl text-brown-1 bg-brown-4 disabled:bg-gray-300 disabled:text-gray-500;
}
</style>
