export default defineNuxtRouteMiddleware(async (to, from) => {
    const { isAuthenticated, fetchUser, user } = useAuth()
    if (isAuthenticated.value && !user.value) {
        await fetchUser()
    }
})