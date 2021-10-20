import API from '../../../base'

export default {
    namespaced: true,
    state: {
        users: []
    },
    getters: {

    },
    mutations: {
        SET_EMPLOYEES(state, data) {
            state.users = data
        },

    },
    actions: {
        async saveEmployee({ commit }, payload) {
            const res = await API.post('/admin/employee', payload).then(res => {
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async updateEmployee({ commit }, payload) {
            const res = await API.put(`/admin/employee/${payload.id}`, payload).then(res => {
                commit('UPDATE_EMPLOYEE', payload);
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async getEmployees({ commit }, { page, sort }) {
            const res = await API.get(`/admin/employee?page=${page}&sort=${sort}`).then(res => {
                commit('SET_EMPLOYEES', res.data)
                return res;
            }).catch(err => {
                return err.response
            })

            return res;
        },
        async deleteEmployee({ commit }, payload) {
            const res = await API.delete(`/admin/employee/${payload.id}`).then(res => {
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