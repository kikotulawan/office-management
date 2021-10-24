import API from '../../../base'

export default {
    namespaced: true,
    state: {
        jobopening: [],
        jobs: [],
        view_job: []
    },
    getters: {

    },
    mutations: {
        SET_JOBOPENING(state, data) {
            state.jobopening = data
        },
        SET_JOBS(state, data) {
            state.jobs = data
        },
        SET_VIEW_JOB(state, { data }) {
            state.view_job = data
        },
        UPDATE_JOBOPENING(state, data) {
            for (let i = 0; i < state.jobopening.data.length; i++) {
                if (state.jobopening.data[i].id == data.id) {
                    state.jobopening.data[i].job_title = data.job_title
                    state.jobopening.data[i].job_description = data.job_description
                    state.jobopening.data[i].job_requirements = data.job_requirements
                    state.jobopening.data[i].job_salary_from = data.job_salary_from
                    state.jobopening.data[i].job_salary_to = data.job_salary_to
                    state.jobopening.data[i].job_type = data.job_type
                    state.jobopening.data[i].job_skills = data.job_skills
                    state.jobopening.data[i].job_work_location = data.job_work_location
                    state.jobopening.data[i].job_min_experience = data.job_min_experience
                    state.jobopening.data[i].job_min_qualification = data.job_min_qualification
                    state.jobopening.data[i].job_opening_expiration = data.job_opening_expiration
                }
            }
        }
    },
    actions: {
        async saveJobOpening({ commit }, payload) {
            const res = await API.post('/admin/jobopening', payload).then(res => {
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async updateJobOpening({ commit }, payload) {
            const res = await API.put(`/admin/jobopening/${payload.id}`, payload).then(res => {
                commit('UPDATE_JOBOPENING', payload);
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async getJobOpening({ commit }, { page, sort }) {
            const res = await API.get(`/admin/jobopening?page=${page}&sort=${sort}`).then(res => {
                commit('SET_JOBOPENING', res.data)
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async viewJob({ commit }, data) {
            const res = await API.get(`/jobs/view/${data.id}`, data).then(res => {
                return res;
            }).catch(err => {
                return err.response;
            })

            return res;
        },
        async getJobs({ commit }, { page, sort }) {
            const res = await API.get(`/jobs?page=${page}&sort=${sort}`).then(res => {
                commit('SET_JOBS', res.data)
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        }

        /** ADD ACTION ON TOP OF THIS */
        /** END OF ACTION */
    },

}