<script lang="ts" setup>
import { AxiosError } from 'axios';

definePageMeta({ layout: 'auth', middleware: 'guest' })
useHead({ title: 'Login', });
const form = ref({
  email: '',
  password: ''
})
const auth = useAuth()
// use same as register
const { pending, execute: login, error } = useAsyncData<any, AxiosError>(async () => (await auth.login(form.value)), { immediate: false })
// fix pending true on first load
pending.value = false
const filled = ref(false)
const canSubmit = computed(() => {
  return filled.value && !pending.value
})
//map errors to form inputs
// watch to enable login button
watch(form, () => {
  //check if all formq fields are filled
  const isFilled = Object.values(form.value).every((value) => value)

  if (isFilled) {
    filled.value = true
  } else {
    filled.value = false
  }
}, { deep: true })


</script>

<template>
  <div>
    <section class="bg-brown-1 font-Inter text-brown-4">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <NuxtLink to="/" class="flex items-center mb-6 text-2xl font-semibold  ">
          <img class="w-16 h-16 mr-2" src="@/assets/logo-icon.png" alt="logo">
        </NuxtLink>
        <div class="w-full bg-brown-2 bg-opacity-20 rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight  md:text-2xl ">
              Sign in to your account
            </h1>
            <form class="space-y-4 md:space-y-6" action="#" @submit.prevent="login()">
              <div>
                <label for="email" class="block mb-2 text-sm font-medium  ">Your email</label>
                <input type="email" name="email" id="email" v-model="form.email"
                  class="bg-brown-1 border border-gray-300 sm:text-sm rounded-lg focus:ring-brown-4 focus:border-brown-4 block w-full p-2.5 placeholder:text-brown-3 placeholder:text-opacity-60"
                  placeholder="name@company.com" required>
              </div>
              <div>
                <label for="password" class="block mb-2 text-sm font-medium ">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                  class="bg-brown-1 border  text-gray-900 sm:text-sm rounded-lg focus:ring-brown-4 focus:border-brown-4 block w-full p-2.5 placeholder:text-brown-3 placeholder:text-opacity-60"
                  v-model="form.password" required>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input id="remember" aria-describedby="remember" type="checkbox"
                      class="w-5 h-5 accent-1 accent-brown-3 rounded ">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="remember" class="text-gray-500">Remember me</label>
                  </div>
                </div>
              </div>
              <button type="submit"
              :disabled="!canSubmit"
              :class="{'bg-brown-4': canSubmit, 'bg-gray-400': !canSubmit}"
                class="w-full text-white  hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Sign
                in</button>
              <p class="text-sm font-light text-gray-500 ">
                Don’t have an account yet? <NuxtLink to="/auth/register"
                  class="font-medium text-brown-4 hover:underline ">Sign up</NuxtLink>
              </p>
              <div v-if="error" class="bg-red-100 p-4 rounded-md text-red-900">
                <span class="material-symbols-sharp mx-auto">
                  warning
                </span>
                <p class="">{{ error?.response?.data.message }}</p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<style scoped></style>
