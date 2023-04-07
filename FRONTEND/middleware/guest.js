export default defineNuxtRouteMiddleware((to, from) => {
    
    if (useAuth().isAuthenticated.value) {
        abortNavigation()
        return navigateTo('/')
    }
})