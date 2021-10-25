import API from '../../base/'

export default {
    namespaced: true,
    state: {
        applicant: [],
        applicationStatus: [],
        allApplicants: [],
        newApplicants: [],
        forInterviewApplicants: [],
        forFinalScreeningApplicants: [],
        forRequirementsApplicants: [],
        view_applicant: []
    },
    getters: {

    },
    mutations: {
        SET_APPLICANTS(state, data) {
            state.allApplicants = data
        },
        SET_NEW_APPLICANTS(state, data) {
            state.newApplicants = data
        },
        SET_INTERVIEW_APPLICANTS(state, data) {
            state.forInterviewApplicants = data
        },
        SET_FINAL_SCREENING_APPLICANTS(state, data) {
            state.forFinalScreeningApplicants = data
        },
        SET_FOR_REQUIREMENTS_APPLICANTS(state, data) {
            state.forRequirementsApplicants = data
        },
        SET_APPLICATION_STATUS(state, data) {
            state.applicationStatus = data
        },
        SET_VIEW_APPLICANT(state, data) {
            state.view_applicant = data
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
        async getNewApplicants({ commit }, { page, sort }) {
            const res = await API.get(`/applicants/newapplicants?page=${page}&sort=${sort}`).then(res => {
                commit('SET_NEW_APPLICANTS', res.data)
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async getForInterviewApplicants({ commit }, { page, sort }) {
            const res = await API.get(`/applicants/for-interview/applicants?page=${page}&sort=${sort}`).then(res => {
                commit('SET_INTERVIEW_APPLICANTS', res.data)
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async getForFinalScreeningApplicants({ commit }, { page, sort }) {
            const res = await API.get(`/applicants/final-screening/applicants?page=${page}&sort=${sort}`).then(res => {
                commit('SET_FINAL_SCREENING_APPLICANTS', res.data)
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async getForRequirementsApplicants({ commit }, { page, sort }) {
            const res = await API.get(`/applicants/for-requirements/applicants?page=${page}&sort=${sort}`).then(res => {
                commit('SET_FOR_REQUIREMENTS_APPLICANTS', res.data)
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
        async viewApplicant({ commit }, data) {
            const res = await API.get(`applicants/view/applicant/${data.id}`, data).then(res => {
                return res;
            }).catch(err => {
                return err.response;
            })

            return res;
        },
    },
}