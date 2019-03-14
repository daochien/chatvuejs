//views
import DashboardView from './components/dashboard/Dashboard.vue';
import ProfileView from './components/user/Profile.vue';
import Home from './components/home/Home.vue';
import Login from './components/home/Login.vue';
import Register from './components/home/Register.vue';

export const routes = [
    { path: '/dashboard', name: 'Dashboard', component: DashboardView},
    { path: '/user/profile', name: 'Profile', component: ProfileView },
    { path: '/', name: 'home', component: Home },
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register }
];
