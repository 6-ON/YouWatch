<template>
	<Transition 
	exit-active-class="transition ease-in duration-300"
	enter-active-class="transition ease-out duration-300"
	>
	<div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50">
		<div
			class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-brown-1 w-96 h-96 rounded-lg z-50">
			<div class="flex flex-col justify-between h-full">
				<div class="flex flex-col  h-full">
					<div class="flex justify-between items-center p-4 border-b border-gray-200">
						<h1 class="text-xl font-bold leading-tight tracking-tight  md:text-2xl ">
							<slot name="title"></slot>
						</h1>
						<button v-if="closable" @click="$emit('close')" class="text-gray-500 hover:text-gray-600">
							<svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								viewBox="0 0 24 24" stroke="currentColor">
								<path d="M6 18L18 6M6 6l12 12">
								</path>
							</svg>
						</button>
					</div>
					<div class="p-4 h-full flex flex-col">
						<slot name="body"></slot>
					</div>
				</div>
				<div class="flex justify-end p-4 border-t border-gray-200">
					<slot name="footer"></slot>
				</div>
			</div>
		</div>
	</div>
	</Transition>
</template>
<script setup>
defineEmits(['close'])
defineProps({
	closable: {
		type: Boolean,
		default: true,
	},
})
</script>