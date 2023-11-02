import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import store from '../store'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/results',
    name: 'result',
    component: () => import('../views/frontend/Result.vue'),
    meta:{
      visitior: true
    }
  }
  ,
  {
    path: '/students',
    name: 'student',
    component: () => import('../views/frontend/Student.vue'),
    meta:{
      visitior: true
    }
  }
  ,
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/Auth/Login.vue'),
    meta:{
      visitior: true
    }
  }
  ,
  {
    path: '/register',
    name: 'register',
    component: () => import('../views/Auth/Register.vue'),
    meta:{
      visitior: true
    }
  }
  ,
  {
    path: '/logout',
    name: 'logout',
    component: () => import('../components/Logout.vue'),
    meta:{
      requiresAuth: true
    }
  }
  ,
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('../views/Backend/Dashboard/Dashboard.vue'),
    meta:{
      requiresAuth: true
    }
    
  },
  {
    path: '/dashboard/department',
    name: 'department',
    component: () => import('../views/Backend/Department/Department.vue'),
    meta:{
      requiresAuth: true
    }
    
  },
  {
    path: '/department/create',
    name: 'create',
    component: () => import('../views/Backend/Department/Add.vue'),
    meta:{
      requiresAuth: true
    }
  },
  {
    path: '/department/:id/edit',
    name: 'departmentEdit',
    component: () => import('../views/Backend/Department/Edit.vue'),
    meta:{
      requiresAuth: true
    }
  }
  ,
  {
    path: '/dashboard/student',
    name: 'students',
    component: () => import('../views/Backend/Student/Students.vue'),
    meta:{
      requiresAuth: true
    }
    
  }
  ,
  {
    path: '/dashboard/result',
    name: 'results',
    component: () => import('../views/Backend/Result/Results.vue'),
    meta:{
      requiresAuth: true
    }
    
  }
  ,
  {
    path: '/student/create',
    name: 'st.create',
    component: () => import('../views/Backend/Student/Add.vue'),
    meta:{
      requiresAuth: true
    }
  }
  ,
  {
    path: '/student/:id/edit',
    name: 'studentEdit',
    component: () => import('../views/Backend/Student/Edit.vue'),
    meta:{
      requiresAuth: true
    }
  }
  ,
  {
    path: '/result/create',
    name: 'rs.create',
    component: () => import('../views/Backend/Result/Add.vue'),
    meta:{
      requiresAuth: true
    }
  }
  ,
  {
    path: '/result/:id/edit',
    name: 'resultEdit',
    component: () => import('../views/Backend/Result/Edit.vue'),
    meta:{
      requiresAuth: true
    }
  }
  ,
  {
    path: '/all/search',
    name: 'search',
    component: () => import('../views/frontend/Search.vue'),
    meta:{
      visitor: true
    }
  }
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.getters.loggedIn) {
      if (localStorage.getItem('authToken')) {
        store.commit('setLoggedIn', true);
        next();
      } else {
        next({ name: 'login' });
      }
    } else {
      next();
    }
  } else if (to.matched.some(record => record.meta.visitor)) {
    if (store.getters.loggedIn) {
      next({ name: 'dashboard' });
    } else {
      next();
    }
  } else {
    next();
  }
});



export default router
