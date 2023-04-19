// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    css: [
        '@/assets/style/fonts.css',
    ],

    modules :['@nuxtjs/tailwindcss', '@vueuse/nuxt','@nuxt/devtools'],
    devtools: true
})
