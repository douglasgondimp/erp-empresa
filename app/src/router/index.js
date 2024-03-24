import { createRouter, createWebHistory } from 'vue-router'
import { useStore } from 'vuex';
import Menu from '@/components/Menu.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
      meta: {
        auth: false
      }
    },
    {
      path: '/clients',
      name: 'clients',
      components: {
        default: () => import('../views/ClientsView.vue'),
        menu: Menu,
      },
      meta: {
        auth: true,
      }
    },
    {
      path: '/companies',
      name: 'companies',
      components: {
        default: () => import('../views/CompaniesView.vue'),
        menu: Menu,
      },
      meta: {
        auth: true,
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  useStore().dispatch('getToken');
  useStore().dispatch('getUser');

  const token = useStore().state.token;
  const user = useStore().state.user;

  if (token && user) {
    if (to.path === '/login') {
      next('/clients');
    }

    next();
  } else if (to.meta?.auth) {
    next('/login');
  } else {
    next();
  }
})

export default router
