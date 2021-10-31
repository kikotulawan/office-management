import Vue from 'vue'
import Vuex from 'vuex'

import auth from './modules/auth'
import position from './modules/human-resource/position'
import employees from './modules/human-resource/employees'
import branches from './modules/human-resource/branches'
import departments from './modules/human-resource/departments'
import policies from './modules/human-resource/policy'
import jobopening from './modules/human-resource/jobopening'
import applicant from './modules/applicant'
import permission from './modules/permission'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        permission,
        position,
        employees,
        branches,
        departments,
        policies,
        jobopening,
        applicant
    }
})