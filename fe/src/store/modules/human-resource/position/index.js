import API from '../../../base'

export default {
  namespaced: true,
  state: {
    positions: [],
  },
  getters: {
   
  },
  mutations: {
    SET_POSITIONS(state, data){
      state.positions = data
    },
    UPDATE_POSITION(state, data) {
      for(let i = 0; i < state.positions.data.length; i++){
        if(state.positions.data[i].id == data.id){
         state.positions.data[i].name = data.name
         state.positions.data[i].description = data.description
        }
       }
    }
  },
  actions: {
    async savePosition({commit}, payload){
      const res = await API.post('/admin/position', payload).then(res => {
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async updatePosition({commit}, payload){
      const res = await API.put(`/admin/position/${payload.id}`, payload).then(res => {
        commit('UPDATE_POSITION', payload);
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async getPositions({commit}, {page, sort}){
      const res = await API.get(`/admin/position?page=${page}&sort=${sort}`).then(res => {
        commit('SET_POSITIONS', res.data)
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