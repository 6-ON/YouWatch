import { AxiosError } from "axios"

export const useAuth = () => {
    const { $axios } = useNuxtApp()
    type User = {
        id: number,
        name: string,
        image: string,
        email: string,
        username: string,
        created_at: string,
        updated_at: string
    }
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
    const isAuthenticated = useLocalStorage('isAuthenticated', false)
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
            const { status } = await $axios.post('/logout', {})
            user.value = null
            isAuthenticated.value = false
            return true
        } catch (error) {
            console.log(error)
        }
    }
    //fetch user method
    async function fetchUser() {
        try {
            const { data } = await $axios.get('/api/user')
            user.value = data
            return true
        } catch ({ response: error }) {
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