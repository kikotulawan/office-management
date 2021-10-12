import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/auth/Login.vue'
import ApplicantLogin from '../views/auth/ApplicantLogin.vue'
import ApplicantRegister from '../views/auth/ApplicantRegister.vue'

import JobPosting from '../views/jobopening/JobOpening.vue'
import Index from '../views/admin/Index.vue'
import Dashboard from '../views/admin/Dashboard.vue'

import HumanResources from '../views/admin/HumanResources.vue'
import Branches from '../views/admin/HumanResources/Branches.vue'
import Departments from '../views/admin/HumanResources/Departments.vue'
import Positions from '../views/admin/HumanResources/Positions.vue'
import Employees from '../views/admin/HumanResources/Employees.vue'
import Holidays from '../views/admin/HumanResources/Holidays.vue'
import Breaks from '../views/admin/HumanResources/Breaks.vue'
import Memos from '../views/admin/HumanResources/Memos.vue'
import Policies from '../views/admin/HumanResources/Policies.vue'
import PayPeriods from '../views/admin/HumanResources/PayPeriods.vue'
import Leaves from '../views/admin/HumanResources/Leaves.vue'
import Applicants from '../views/admin/HumanResources/Applicants.vue'
import JobOpening from '../views/admin/HumanResources/JobOpening.vue'

Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'Login',
        component: Login,
        meta: { hasUser: true }
    },
    {
        path: '/jobs',
        name: 'JobPosting',
        component: JobPosting
    },
    {
        path: '/jobs/applicant/login',
        name: 'ApplicantLogin',
        component: ApplicantLogin
    },
    {
        path: '/jobs/applicant/register',
        name: 'ApplicantRegister',
        component: ApplicantRegister
    },
    {
        path: '/home',
        name: 'Home',
        component: Index,
        meta: { isAdmin: true, requiresLogin: true },
        children: [{
                path: 'dashboard',
                name: 'dashboard',
                components: {
                    dashboard: Dashboard
                }
            },
            {
                path: 'human-resources',
                name: 'humanresources',
                redirect: '/home/human-resources/branches',
                components: {
                    humanresources: HumanResources
                },
                children: [{
                        path: 'branches',
                        name: 'branches',
                        components: {
                            branches: Branches
                        }
                    },
                    {
                        path: 'departments',
                        name: 'departments',
                        components: {
                            departments: Departments
                        }
                    },
                    {
                        path: 'positions',
                        name: 'positions',
                        components: {
                            positions: Positions
                        }
                    },
                    {
                        path: 'employees',
                        name: 'employees',
                        components: {
                            employees: Employees
                        }
                    },
                    {
                        path: 'holidays',
                        name: 'holidays',
                        components: {
                            holidays: Holidays
                        }
                    },
                    {
                        path: 'breaks',
                        name: 'breaks',
                        components: {
                            breaks: Breaks
                        }
                    },
                    {
                        path: 'memos',
                        name: 'memos',
                        components: {
                            memos: Memos
                        }
                    },
                    {
                        path: 'policies',
                        name: 'policies',
                        components: {
                            policies: Policies
                        }
                    },
                    {
                        path: 'pay-periods',
                        name: 'payperiods',
                        components: {
                            payperiods: PayPeriods
                        }
                    },
                    {
                        path: 'leaves',
                        name: 'leaves',
                        components: {
                            leaves: Leaves
                        }
                    },
                    {
                        path: 'applicants',
                        name: 'applicants',
                        components: {
                            applicants: Applicants
                        }
                    },
                    {
                        path: 'jobopening',
                        name: 'jobopening',
                        components: {
                            jobopening: JobOpening
                        }
                    },
                ]
            },
            {
                path: '/',
                redirect: { name: 'humanresources' }
            }
        ]
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresLogin) && !localStorage.getItem('auth')) {
        next({ name: 'Login' })
    } else if (to.matched.some((record) => record.meta.hasUser) && localStorage.getItem('auth') && localStorage.getItem('isAdmin')) {
        next({ name: "dashboard" });
    } else {
        next();
    }
});

export default router