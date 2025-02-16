import { createRouter, createWebHistory } from 'vue-router'

// Views
import MainView from '../views/MainView.vue'
import DashboardView from '../views/DashboardView.vue'

// Pages
// --- Landing Page ---
import HomePage from '../pages/LandingPage/HomePage.vue'
import TeamPage from '../pages/LandingPage/TeamPage.vue'

// Dashboard Pages
import DashboardHome from '../pages/Dashboard/Home.vue'
import DashboardQuest from '../pages/Dashboard/Quest.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'landingPage',
      component: MainView,
      redirect: {path: "/home"},
      children: [
        {
          path: '/home',
          name: 'home',
          component: HomePage
        },
        {
          path: '/team',
          name: 'team',
          component: TeamPage
        }
      ]
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: DashboardView,
      redirect: {path: "/dashboard/home"},
      children: [
        {
          path: '/dashboard/home',
          name: 'dashboardHome',
          component: DashboardHome
        },
        {
          path: '/dashboard/quest',
          name: 'dashboardQuest',
          component: DashboardQuest
        }
      ]
    }
  ]
})

export default router
