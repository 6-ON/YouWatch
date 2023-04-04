export default defineNuxtRouteMiddleware((to, from) => {
    
    if (useAuth().isAuthenticated.value) {
        return navigateTo('/')
    }
})