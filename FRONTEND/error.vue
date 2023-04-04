<template>
  <main class="h-screen w-full flex flex-col justify-center items-center bg-brown-1">
    <h1 class="text-9xl font-extrabold text-brown-2 tracking-widest">{{ error.statusCode }}</h1>
    <div class="bg-red-400 text-brown-1 px-2 text-sm rounded rotate-12 absolute">
      {{ error.statusMessage }}
    </div>
    <button class="mt-5">
      <NuxtLink to="/"
        class="relative inline-block text-sm font-medium text-brown-1 group focus:outline-none focus:ring">
        <span
          class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-brown-2 group-hover:translate-y-0 group-hover:translate-x-0"></span>

        <span class="relative block px-8 py-3 bg-brown-4 border border-brown-2">
          <router-link to="/">Go Home</router-link>
        </span>
      </NuxtLink>
    </button>
  </main>
</template>
  
<script setup>
const error = useError()
</script>
  