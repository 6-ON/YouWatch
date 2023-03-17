<script setup>
const sidebar = useSidebar()
</script>

<template>
	<div>
		<TransitionsFade>
			<div class="w-full h-screen bg-black bg-opacity-20 fixed top-0 left-0 z-20 backdrop:blur" v-if="!sidebar.isLocked() && !sidebar.isCollapsed()"
				@click="sidebar.toggle"></div>
		</TransitionsFade>
		<div class="z-20 fixed top-0 h-screen bg-brown-2 flex flex-col items-center py-10 transition-all duration-100 w-[20rem] text-brown-4 font-Montserrat font-semibold "
			:class="{ 'left-0': !sidebar.isCollapsed(), '-left-[20rem]': sidebar.isCollapsed() }">
			<div class="flex items-center mb-16 justify-center w-full gap-2">
				<NuxtLink to="#"><img class="w-20" src="@/assets/logo-icon.png"></NuxtLink>
			</div>
			<div class="flex flex-col items-center gap-2 w-full antialiased">
				<SidebarLink to="/" >
					<span class="material-symbols-sharp text-4xl ">
						home
					</span>
					<span>Home</span>
				</SidebarLink>

				<SidebarLink to="/library" >
					<span class="material-symbols-sharp">
						video_library
					</span>
					<span>Library</span>
				</SidebarLink>
			</div>

			<div class="w-full mt-auto">
				<SidebarLink to="/settings" icon="IconsHome">
					<span class="material-symbols-sharp">
						settings
					</span>
					<span>Settings</span>
				</SidebarLink>
			</div>
		</div>
	</div>
</template>
