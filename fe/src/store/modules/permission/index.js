import API from '../../base'

export default {
    namespaced: true,
    state: {
        permissions: [],
        rolepermissions: []
    },
    getters: {},
    mutations: {
        SET_PERMISSIONS(state, data) {
            state.permissions = data
        },
        SET_AVAILABLE_PERMISSIONS(state, data) {
            state.rolepermissions = data
        },
        REMOVE_PERMISSIONS(state, data) {
            for (let i = 0; i < state.permissions.data.length; i++) {
                if (state.permissions.data[i].id == data) {
                    state.permissions.data[i].permission = [];
                }
            }
        }
    },
    actions: {
        async getAllPermissions({ commit }) {
            const res = await API.get(`/admin/permissions/all`).then(res => {
                commit('SET_AVAILABLE_PERMISSIONS', res.data)
                return res;
            }).catch(err => {
                return err.response;
            })

            return res;
        },
        async getRolePermissions({ commit }, page) {
            const res = await API.get(`/admin/permissions?page=${page}`).then(res => {
                commit('SET_PERMISSIONS', res.data)
                return res;
            }).catch(err => {
                return err.response;
            })

            return res;
        },
        async searchRolePermission({ commit }, { page, data }) {
            const res = await API.post(`/admin/permissions/search?page=${page}`, data).then(res => {
                commit('SET_PERMISSIONS', res.data)

                return res;
            }).catch(err => {
                return err.response;
            })

            return res;
        },
        async updateRolePermission({ commit }, data) {
            const res = await API.put(`/admin/permissions/${data.id}`, data).then(res => {
                return res;
            }).catch(err => {
                return err.response;
            })

            return res;
        },
        async deleteRolePermission({ commit }, id) {
            const res = await API.delete(`/admin/permissions/${id}`).then(res => {
                // commit('REMOVE_PERMISSIONS', id);
                return res;
            }).catch(err => {
                return err.response;
            })

            return res;
        },
    }
}