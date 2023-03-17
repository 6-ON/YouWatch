<template>
    <div class="w-96 bg-brown-1">
        <NuxtLink to="#" class="relative">
            <img src="https://images.pexels.com/photos/1126359/pexels-photo-1126359.jpeg?auto=compress&cs=tinysrgb&w=960&h=480&dpr="
                alt="Video thumbnail" class="w-full h-full rounded-lg object-cover">
            <span
                class="absolute select-none bottom-1 right-1 bg-brown-1 text-brown-4 px-1 py-1 text-xs font-semibold rounded">02:01</span>
        </NuxtLink>
        <div class="px-3 py-2 flex items-center justify-between">
            <div class="flex gap-4 items-center">
                <NuxtLink to="#">
                    <UserAvatar
                        image="https://images.pexels.com/users/avatars/353287/suzy-hazelwood-390.jpeg?auto=compress&fit=crop&h=128&w=128&dpr=1">
                    </UserAvatar>
                </NuxtLink>
                <div class="flex flex-col font-Inter">
                    <NuxtLink to="#" class="text-lg font-bold">How to make a cake</NuxtLink>
                    <NuxtLink to="#" class="text-md font-medium">lala hadda</NuxtLink>
                    <p class="text-gray-500 text-sm">14k views • 1day ago</p>

                </div>
            </div>
            <button>
                <span class="material-symbols-sharp" style="font-size: 32px;">
                    more_vert
                </span>
            </button>
        </div>
    </div>
</template>