import API from '../../base/'

export default {
    namespaced: true,
    state: {
        user: {
            admininfo: {
                first_name: '',
                last_name: '',
            }
        },
        userinfo: [],
        useraccount: [],
        signup: '',
        token: localStorage.getItem('auth') || ''
    },
    getters: {
        GET_USER(state) {
            return state.user;
        }
    },
    mutations: {
        SET_AUTH_ACC(state, data) {
            state.userinfo = data.user_info
            state.useraccount = data.user_account
            const bearer_token = localStorage.getItem('auth') || ''
            API.defaults.headers.common['Authorization'] = `Bearer ${bearer_token}`
        },
        SET_ACC(state, data) {
            state.user = data
            const bearer_token = localStorage.getItem('auth') || ''
            API.defaults.headers.common['Authorization'] = `Bearer ${bearer_token}`
        },
        SET_APPLICANT_TOKEN(state, token) {
            localStorage.setItem('auth', token)
            localStorage.setItem('isApplicant', 'true')
            state.token = token

            const bearer_token = localStorage.getItem('auth') || ''
            API.defaults.headers.common['Authorization'] = `Bearer ${bearer_token}`
        },
        SET_AUTH_TOKEN(state, token) {
            localStorage.setItem('auth', token)
            localStorage.setItem('isAdmin', 'true')
            state.token = token

            const bearer_token = localStorage.getItem('auth') || ''
            API.defaults.headers.common['Authorization'] = `Bearer ${bearer_token}`
        },
        UNSET_USER(state) {
            localStorage.removeItem('auth');
            localStorage.removeItem('isUser');
            localStorage.removeItem('isAdmin');
            localStorage.removeItem('isApplicant');
            state.token = ''
            state.user = ''

            API.defaults.headers.common['Authorization'] = ''
        }
    },
    actions: {
        async loginAccount({ commit }, payload) {
            const res = await API.post('/auth/admin/login', payload).then(res => {
                commit('SET_AUTH_ACC', res.data)
                commit('SET_AUTH_TOKEN', res.data.access_token)

                return res;
            }).catch(err => {
                return err
            })

            return res;
        },
        async applicantLogin({ commit }, data) {
            const res = await API.post(`user/auth/login`, data).then(res => {
                commit('SET_AUTH_ACC', res.data)
                commit('SET_APPLICANT_TOKEN', res.data.access_token)

                return res;
            }).catch(err => {
                return err.response
            })

            return res
        },
        async applicantRegister({ commit }, data) {
            const res = await API.post(`user/auth`, data).then(res => {
                return res;
            }).catch(err => {
                return err.response
            })

            return res
        },
        async updateAdminAccount({ commit }, data) {
            const res = await API.post(`auth/admin/update`, data).then(res => {
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async logoutUser({ commit }) {
            const res = await API.post('auth/admin/logout?token=' + localStorage.getItem('auth')).then(response => {
                commit('UNSET_USER')
                return response
            }).catch(error => {
                return error.response
            });

            return res;
        },
        async checkUser({ commit }) {
            const res = await API.post('auth/admin/me?token=' + localStorage.getItem('auth')).then(res => {
                commit('SET_ACC', res.data)
                return res;
            }).catch(error => {
                commit('UNSET_USER')
                window.location.reload()
            })

            return res;
        },
        async changeAdminPassword({ commit }, data) {
            const res = await API.post('auth/admin/change_password', data).then(res => {
                return res;
            }).catch(error => {
                return error.response;
            })

            return res;
        },
    },
}