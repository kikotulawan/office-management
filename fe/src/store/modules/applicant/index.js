import API from '../../base/'

export default {
    namespaced: true,
    state: {
        applicant: [],
    },
    getters: {

    },
    mutations: {

    },
    actions: {
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
        async applyJob({ commit }, data) {
            const res = await API.post(`user/job`, data).then(res => {

                return res;
            }).catch(err => {
                return err.response
            })

            return res
        }
    },
}