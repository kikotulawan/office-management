import API from '../../../base'

export default {
  namespaced: true,
  state: {
    departments: [],
    alldepartments: [],
  },
  getters: {
   
  },
  mutations: {
    SET_DEPARTMENTS(state, data){
      state.departments = data
    },
    SET_ALL_DEPARTMENTS(state, data){
      state.alldepartments = data
    },
    UPDATE_DEPARTMENT(state, data) {
      for(let i = 0; i < state.departments.data.length; i++){
        if(state.departments.data[i].id == data.id){
         state.departments.data[i].name = data.name
         state.departments.data[i].contact_number = data.contact_number
         state.departments.data[i].person_in_charge = data.person_in_charge
        }
       }
    }
  },
  actions: {
    async allDepartments({commit}){
      const res = await API.get('/admin/department/allDepartments').then(res => {
        commit('SET_ALL_DEPARTMENTS', res.data)
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async saveDepartment({commit}, payload){
      const res = await API.post('/admin/department', payload).then(res => {
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async updateDepartment({commit}, payload){
      const res = await API.put(`/admin/department/${payload.id}`, payload).then(res => {
        commit('UPDATE_DEPARTMENT', payload);
        return res;
      }).catch(err => {
        return err.response
      })

      return res;
    },
    async getDepartments({commit}, {page, sort}){
      const res = await API.get(`/admin/department?page=${page}&sort=${sort}`).then(res => {
        commit('SET_DEPARTMENTS', res.data)
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