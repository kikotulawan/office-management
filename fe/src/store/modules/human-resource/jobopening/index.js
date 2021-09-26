import API from '../../../base'

export default {
  namespaced: true,
  state: {
    jobopening: [],
    jobs: []
  },
  getters: {
   
  },
  mutations: {
    SET_JOBOPENING(state, data){
      state.jobopening = data
    },
    SET_JOBS(state, data){
      state.jobs = data
    },
    UPDATE_JOBOPENING(state, data) {
      for(let i = 0; i < state.jobopening.data.length; i++){
        if(state.jobopening.data[i].id == data.id){
         state.jobopening.data[i].job_title = data.job_title
         state.jobopening.data[i].salary = data.salary
        }
       }
    }
  },
  actions: {
    async saveJobOpening({commit}, payload){
      const res = await API.post('/admin/jobopening', payload).then(res => {
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async updateJobOpening({commit}, payload){
      const res = await API.put(`/admin/jobopening/${payload.id}`, payload).then(res => {
        commit('UPDATE_JOBOPENING', payload);
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async getJobOpening({commit}, {page, sort}){
      const res = await API.get(`/admin/jobopening?page=${page}&sort=${sort}`).then(res => {
        commit('SET_JOBOPENING', res.data)
        return res;
      }).catch(err => {
        return err.response
      })
  
      return res;
    },
    async getJobs({commit}, {page, sort}){
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