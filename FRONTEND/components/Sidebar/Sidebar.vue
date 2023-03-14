<script setup>
const collapsed = useState('sidebarColapsed', () => false)
</script>

<template>
	<div>
		<TransitionsFade>
			<div class="w-full h-screen bg-black bg-opacity-10 fixed top-0 z-20" v-if="!collapsed"
				@click="collapsed = !collapsed"></div>
		</TransitionsFade>
		<div class="z-20 fixed top-0 h-screen bg-brown-2 flex flex-col items-center py-10 transition-all duration-100 w-[20rem]"
			:class="{ 'left-0': !collapsed, '-left-[20rem]': collapsed }">
			<div class="flex items-center mb-16 justify-center w-full gap-2">
				<NuxtLink to="#"><img class="w-20" src="@/assets/logo-icon.png"></NuxtLink>
			</div>
			<div class="flex flex-col items-center gap-2 w-full font-Montserrat font-semibold antialiased text-brown-4">
				<SidebarLink to="/" icon="IconsHome" >
					<IconsHome class="w-7"/>
					<span>Home</span>
				</SidebarLink>
				<SidebarLink to="/Library" icon="IconsHome" >
					<IconsHome class="w-7"/>
					<span>Home</span>
				</SidebarLink>
			</div>

			<div class="w-8 mt-auto">
				<IconsSettings></IconsSettings>
			</div>
		</div>
	</div>
</template>
