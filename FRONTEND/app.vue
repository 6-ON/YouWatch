<script setup>
useHead({
  link:[
    { rel:'icon',href: './logo-icon.png'}
  ],
  bodyAttrs: {
    class: 'bg-brown-1'
  }
})
</script>
<template>
  <div>
    <NuxtLayout>
      <NuxtPage></NuxtPage>
    </NuxtLayout>
  </div>
</template>
