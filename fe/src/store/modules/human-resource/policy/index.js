import API from '../../../base'

export default {
  namespaced: true,
  state: {
    policies: [],
  },
  getters: {
   
  },
  mutations: {
    SET_POLICIES(state, data){
      state.policies = data
    },
    UPDATE_POLICY(state, data) {
      for(let i = 0; i < state.policies.data.length; i++){
        if(state.policies.data[i].id == data.id){
         state.policies.data[i].name = data.name
         state.policies.data[i].description = data.description
        }
       }
    }
  },
  actions: {
    async savePolicy({commit}, payload){
      const res = await API.post('/admin/policy', payload).then(res => {
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async updatePolicy({commit}, payload){
      const res = await API.put(`/admin/policy/${payload.id}`, payload).then(res => {
        commit('UPDATE_POLICY', payload);
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async getPolicies({commit}, {page, sort}){
      const res = await API.get(`/admin/policy?page=${page}&sort=${sort}`).then(res => {
        commit('SET_POLICIES', res.data)
        return res;
      }).catch(err => {
        return err.response
      })
  
      return res;
    },
    async deletePolicy({commit}, payload){
      const res = await API.delete(`/admin/policy/${payload.id}`).then(res => {
        return res;
      }).catch(err => {
        return err.response
      })
    }

    /** ADD ACTION ON TOP OF THIS */
    /** END OF ACTION */
  },
  
}