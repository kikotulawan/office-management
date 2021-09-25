import API from '../../../base'

export default {
  namespaced: true,
  state: {
    branches: [],
  },
  getters: {
   
  },
  mutations: {
    SET_BRANCHES(state, data){
      state.branches = data
    },
    UPDATE_BRANCH(state, data) {
      for(let i = 0; i < state.branches.data.length; i++){
        if(state.branches.data[i].id == data.id){
         state.branches.data[i].name = data.name
         state.branches.data[i].address = data.address
         state.branches.data[i].contact_number = data.contact_number
         state.branches.data[i].person_in_charge = data.person_in_charge
        }
       }
    }
  },
  actions: {
    async saveBranch({commit}, payload){
      const res = await API.post('/admin/branch', payload).then(res => {
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async updateBranch({commit}, payload){
      const res = await API.put(`/admin/branch/${payload.id}`, payload).then(res => {
        commit('UPDATE_BRANCH', payload);
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async getBranches({commit}, {page, sort}){
      const res = await API.get(`/admin/branch?page=${page}&sort=${sort}`).then(res => {
        commit('SET_BRANCHES', res.data)
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