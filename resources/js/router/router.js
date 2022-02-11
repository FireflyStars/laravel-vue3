import { createWebHistory, createRouter } from "vue-router";

import Login from '../components/Login';
import Dashboard from '../components/Dashboard';
import { useCookies } from "vue3-cookies";
const { cookies } = useCookies();

const routes = [
    {
      path: "/",
      name: "Login",
      component: Login,
    },
    {
      path: "/dashboard",
      name: "Dashboard",
      component: Dashboard,
    },
  ];

  const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  router.beforeEach((to, from, next) => {
    if (to.name !== 'Login' && !cookies.isKey('userInfo')) next({ name: 'Login' })
    else next()
  })  
export default router;