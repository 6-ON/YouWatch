// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    css: [
        '@/assets/style/fonts.css',
        'animate.css/animate.min.css'
    ],
    modules :['@nuxtjs/tailwindcss', '@vueuse/nuxt']
})
