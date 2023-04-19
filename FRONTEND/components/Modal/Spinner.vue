<template>
    <!-- loading spinner Modal with caption -->
    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50">
        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-brown-1 w-96 h-96 rounded-lg z-50">
            <div class="flex flex-col justify-around items-center h-full">
                <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900"></div>
                <p class="text-brown-4 font-semibold text-lg">
                    <slot></slot>
                </p>
            </div>
        </div>
    </div>

</template>