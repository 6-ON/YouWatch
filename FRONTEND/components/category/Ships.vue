<script lang="ts" setup>
const { $axios } = useNuxtApp()
const { data: tags, pending } = useAsyncData('tags',async () => (await $axios.get('/api/tags')).data)
const selectedTags = useState<Array<string>>('selectedTags')
function addTag(tag: string) {
    if (selectedTags.value.includes(tag)) {
        selectedTags.value.splice(selectedTags.value.indexOf(tag), 1)
    } else {
        selectedTags.value.push(tag)
    }
}
</script>

<template>
    <div class="w-full bg-brown-1 flex px-4 py-2 gap-4 overflow-x-scroll font-Inter">
        <PlaceholderShip v-if="pending" v-for="tag in 6" />
        <CategoryShip v-else v-for="tag in tags" @click="addTag(tag.name.en)"
            :is-active="selectedTags.includes(tag.name.en)">
            {{ tag.name.en }}
        </CategoryShip>
    </div>
</template>