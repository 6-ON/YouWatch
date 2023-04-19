export default defineNuxtRouteMiddleware(async (to, from) => {
    console.log(to.query.q);

    try {
        if (!to.query.q) {
            throw new Error('No query');
        }
    } catch (error) {

        return abortNavigation({
            statusCode: 404,
            statusMessage: 'Not Found',
            fatal: true,
        });
    }
})
