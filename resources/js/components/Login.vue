<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
        <div>
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
        </div>
        <form class="mt-8 space-y-6" action="#" method="POST" @submit.prevent="signin">
            <input type="hidden" name="remember" value="true" />
            <div v-if="errorMessage != ''" class="bg-orange-200 rounded-md h-10 flex items-center px-1 text-slate-600" v-html="errorMessage">
            </div>
            <div class="rounded-md shadow-sm -space-y-px">
            <div>
                <label for="email-address" class="sr-only">Email address</label>
                <input id="email-address" v-model="email" type="email" autocomplete="email" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address" />
            </div>
            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" v-model="password" type="password" autocomplete="current-password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password" />
            </div>
            </div>

            <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
            </div>

            <div class="text-sm">
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> Forgot your password? </a>
            </div>
            </div>

            <div>
            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                </span>
                Sign in
                <svg v-if="isLoading" class="animate-spin ml-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            </div>
        </form>
        </div>
    </div>
</template>

<script>
import { LockClosedIcon } from '@heroicons/vue/solid'
import { mapActions } from 'vuex';
export default {
    components: {
        LockClosedIcon,
    },
    data(){
        return{
            email: '',
            password: '',
            loginSubmitUrl: '/login',
            isLoading: false,
            errorMessage: '',
        }
    },
    computed:{

    },    
    methods:{
        ...mapActions({
            Login: 'LOGIN',
        }),        
        async signin(){
            this.isLoading = true;
            await axios.get('/sanctum/csrf-cookie').then(async () => {
                await axios.post(this.loginSubmitUrl, {
                    'email': this.email,
                    'password': this.password
                }).then( () => {
                    this.getUserInfo();
                }).catch(error => {
                    this.isLoading = false;
                    if(error.response.data.errors.email != undefined){
                        this.errorMessage = error.response.data.errors.email[0];
                    }
                    if(error.response.data.errors.password != undefined){
                        this.errorMessage = error.response.data.errors.password[0];
                    }
                })
            }).catch(error=> {
                this.isLoading = false;
                console.log(error);
            });
        },
        async getUserInfo(){
            await axios.get('/sanctum/csrf-cookie').then(async () => {
                await axios.get('api/user').then( response => {
                    this.Login(response.data);
                    this.isLoading = false;
                    this.$router.push('dashboard');
                }).catch(error => {
                    console.log(error);
                })
            }).catch(error=> {
                this.isLoading = false;
                console.log(error);
            });
        }
    }
}
</script>