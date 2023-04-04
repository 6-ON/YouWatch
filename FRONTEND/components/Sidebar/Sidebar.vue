<script setup>
const sidebar = useSidebar()
const stateClass = computed(() => {
	if (!sidebar.collapsed()) {
		return 'w-[15rem]'
	}
	else if (sidebar.locked()) {
		return 'w-[4rem]'
	} else {
		return 'w-0'
	}
})
</script>

<template>
	<div>
		<TransitionsFade>
			<div class="w-full h-screen bg-black bg-opacity-20 fixed top-0 left-0 z-10 backdrop:blur"
				v-if="!sidebar.locked() && !sidebar.collapsed()" @click="sidebar.hide"></div>
		</TransitionsFade>

		<div class="fixed z-20 top-0 left-0 h-screen bg-brown-1 flex flex-col items-center pb-10 pt-20  text-brown-4 font-Montserrat font-semibold overflow-x-hidden "
			:class="stateClass">

			<div class="flex flex-col items-center gap-2 w-full antialiased">
				<SidebarLink to="/" icon="home">
					Home
				</SidebarLink>

				<SidebarLink to="/library" icon="video_library">
					Library
				</SidebarLink>
				<SidebarLink to="/subscriptions" icon="subscriptions">
					Subscriptions
				</SidebarLink>
			</div>

			<div class="w-full mt-auto">
				<SidebarLink to="/settings" icon="settings">
					Settings
				</SidebarLink>
			</div>
		</div>
	</div>
</template>
