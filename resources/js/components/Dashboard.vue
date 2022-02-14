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
import { mapActions, useStore } from 'vuex';
import { useCookies } from "vue3-cookies";
import { computed, onMounted } from 'vue';
export default {
    setup: () => {
        const store = useStore();
        const { cookies } = useCookies();

        const loadSubjects = async () => {
            await axios.get('/sanctum/csrf-cookie').then(async () => {
                await axios.get('/api/subjects').then( response => {
                    store.dispatch('SetUserSubject', response.data.data);
                }).catch(error => {
                    console.log(error);
                })
            });
        };
        
        onMounted(() => {
          loadSubjects();
        });

        return {
            logoutUrl: '/logout',
            userInfo : store.state.userInfo != null ? store.state.userInfo : cookies.get('userInfo'),
            subjects : computed(() => store.getters.getSubject),
        }
    },

    methods: {
        ...mapActions({
            Logout: 'LOGOUT',
        }),
        async logout(){
            await axios.get('/sanctum/csrf-cookie').then( async () => {
                await axios.post(this.logoutUrl).then( () => {
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