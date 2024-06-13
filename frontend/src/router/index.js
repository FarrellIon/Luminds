import { createRouter, createWebHistory } from 'vue-router'

// Views
import MainView from '../views/MainView.vue'

// Pages
// --- Landing Page ---
import HomePage from '../pages/LandingPage/HomePage.vue'
import TeamPage from '../pages/LandingPage/TeamPage.vue'

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
  ]
})

export default router
