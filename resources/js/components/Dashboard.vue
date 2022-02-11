<template>
  <div class="flex flex-col">
    <div class="my-2 overflow-x-auto">
        <h1 class="h1 text-center">Welcome {{ userInfo.name }}, <a href="javascript:;" class="text-red-500 cursor-pointer" @click="logout">Logout</a></h1>
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(subject, index) in subjects" :key="subject.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ index+1 }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ subject.name }}</div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions, mapState } from 'vuex';
import { useCookies } from "vue3-cookies";

export default {
    setup: () => {
        const { cookies } = useCookies();
        return {
            userInfo : cookies.get('userInfo')
        }
    },
    data(){
        return{
            logoutUrl: '/logout'
        }
    },
    computed:{
        ...mapGetters({
            // map `this.getSubject` to `this.$store.getters.getSubject`
            subjects: 'getSubject',            
        }),
        ...mapState({
            // map this.userInfo to store.state.userInfo
            userInfo: state => state.userInfo,            
        })
    },
    mounted(){
        if(this.subjects.length == 0){
            this.loadSubjects();
        }

    },
    methods: {
        ...mapActions({
            SetSubjects: 'SetUserSubject', // map `this.SetUserSubject()` to `this.$store.dispatch('SetUserSubject')`,
            Logout: 'LOGOUT',
        }),
        loadSubjects(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/subjects').then( res => {
                    this.SetSubjects(res.data.data);
                }).catch(error => {
                    console.log(error);
                })
            });
        },
        logout(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post(this.logoutUrl).then( res => {
                    this.$router.push({ name: 'Login' });
                    this.Logout();
                }).catch(error => {
                    console.log(error);
                })
            });
        }
    }
}
</script>