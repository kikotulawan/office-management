import API from '../../../base'

export default {
  namespaced: true,
  state: {
    policies: [],
    allpolicies: [],
    overtimepolicies: [],
    allovertimepolicies: [],
  },
  getters: {
   
  },
  mutations: {
    SET_POLICIES(state, data){
      state.policies = data
    },
    SET_ALL_POLICIES(state, data){
      state.allpolicies = data
    },
    SET_OVERTIME_POLICIES(state, data){
      state.overtimepolicies = data
    },
    SET_ALL_OVERTIME(state, data){
      state.allovertimepolicies = data
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
    async allPolicy({commit}){
      const res = await API.get('/admin/policy/allPolicy').then(res => {
        commit('SET_ALL_POLICIES', res.data)
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
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

      return res;
    },

    /* OVERTIME POLICY */
    async allOverTimePolicy({commit}){
      const res = await API.get('/admin/overtime/allOvertime').then(res => {
        commit('SET_ALL_OVERTIME', res.data)
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async getOverTimePolicies({commit}, {page, sort}){
      const res = await API.get(`/admin/overtime?page=${page}&sort=${sort}`).then(res => {
        commit('SET_OVERTIME_POLICIES', res.data)
        return res;
      }).catch(err => {
        return err.response
      })
  
      return res;
    },
    async saveOverTimePolicy({commit}, payload){
      const res = await API.post('/admin/overtime', payload).then(res => {
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async deleteOverTimePolicy({commit}, payload){
      const res = await API.delete(`/admin/overtime/${payload.id}`).then(res => {
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