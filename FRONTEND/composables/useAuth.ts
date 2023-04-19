export const useAuth = () => {
    const { $axios } = useNuxtApp()

    type loginData = {
        email: string,
        password: string
    }
    type registerData = {
        name: string,
        email: string,
        password: string,
        username: string
    }

    const user = useState<User | null>('AuthUser', () => null);

    const exp = new Date()
    exp.setHours(exp.getHours() + 2)
    const isAuthenticated = useCookie('isAuthenticated', { default: () => false, expires: exp });
    //create cookie that expires in 2 hours

    watch(isAuthenticated, (value) => {
        navigateTo('/')
    })

    const getToken = async () => {
        await $axios.get('/sanctum/csrf-cookie');
    }

    async function login({ email, password }: loginData) {

        await getToken();
        const { status } = await $axios.post('/login', { email, password });
        await fetchUser();
        isAuthenticated.value = true;
        return true;

    }
    //register method
    async function register({ name, email, password, username }: registerData) {
        await getToken();
        const { data } = await $axios.post('/register', { name, email, password, username });
        await fetchUser();
        isAuthenticated.value = true;
        return data;
    }
    //logout method
    async function logout() {
        try {
            await getToken()
            const { status } = await $axios.post('/logout')
            if (status === 204) {
                isAuthenticated.value = false
                user.value = null
                return true
            } else return false
        } catch (error) {
            console.log(error)
            return false
        }
    }
    //fetch user method
    async function fetchUser() {
        try {
            const { data } = await $axios.get('/api/user')
            user.value = data
            return true
        } catch ({ response: error }: any) {
            if (error.status === 401) {
                console.log(error.data.message)
            }
            return false
        }
    }



    return {
        user,
        isAuthenticated,
        fetchUser,
        login,
        register,
        logout
    }
}