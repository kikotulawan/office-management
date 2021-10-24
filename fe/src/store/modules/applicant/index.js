import API from '../../base/'

export default {
    namespaced: true,
    state: {
        applicant: [],
        applicationStatus: [],
        allApplicants: [],
    },
    getters: {

    },
    mutations: {
        SET_APPLICANTS(state, data) {
            state.allApplicants = data
        },
        SET_APPLICATION_STATUS(state, data) {
            state.applicationStatus = data
        }
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
        },
        async getApplicants({ commit }, { page, sort }) {
            const res = await API.get(`/applicants?page=${page}&sort=${sort}`).then(res => {
                commit('SET_APPLICANTS', res.data)
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async getApplicationStatus({ commit }, { page, sort }) {
            const res = await API.get(`user/auth/appliedjobs?page=${page}&sort=${sort}`).then(res => {
                commit('SET_APPLICATION_STATUS', res.data)
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
    },
}