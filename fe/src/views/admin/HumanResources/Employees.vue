<template>
    <div>
     <div class="container-fluid">
         <div class="card p-5 mt-3 mb-5">
            <h5>Employees</h5>
            <p class="text-muted">Manage your employees below</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm shadow-none" @click="$bvModal.show('addEmployeeModal')"> <i class="bi bi-plus"></i>Add Employee</button>
            </div>
            <b-skeleton-table
                :rows="7"
                :columns="6"
                :table-props="{ bordered: true, striped: true }"
                class="mt-4"
                v-if="initialLoading"
                ></b-skeleton-table>
                <table class="table table-striped table-hover mt-4" v-else>
                    <caption>Showing to of data</caption>
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Name <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                        <th scope="col">Branch</th>
                        <th scope="col">Wage</th>
                        <th scope="col">Regular Holiday</th>
                        <th scope="col">Special Holiday</th>
                        <th scope="col">Overtime</th>
                        <th scope="col">Policies</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td scope="row"></td>
                            <td scope="row"></td>
                            <td scope="row"></td>
                            <td scope="row"></td>
                            <td scope="row"></td>
                            <td scope="row"></td>
                            <td scope="row"></td>
                            <td>
                                <a href="" class="btn btn-secondary btn-sm rounded-pill shadow-none">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <!-- <div class="row mt-3">
              <pagination :showDisabled="true" :align="'right'" :data="branches" @pagination-change-page="getBranches">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div> -->
         </div>
     </div>

      <b-modal id="addEmployeeModal" size="lg" hide-footer scrollable centered title="Add Employee">
          <form ref="branchform" @submit.prevent="saveEmployee" class="p-2">
            <h5 class="mb-2">Personal Info</h5>
            <div class="row">
                <div class="col-6">
                    <label class="" :class="{ 'form-input-label--error': $v.data.first_name.$error }">First Name</label>
                    <input v-model.trim="$v.data.first_name.$model" class="shadow-none form-control" type="text" :class="{ 'form-input--error': $v.data.first_name.$error }">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.last_name.$error }">Last Name</label>
                    <input v-model.trim="$v.data.last_name.$model" class="shadow-none form-control" type="text" :class="{ 'form-input--error': $v.data.last_name.$error }">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.emergency_contact_person.$error }">Person to Notify of Emergencies</label>
                    <input v-model.trim="$v.data.emergency_contact_person.$model" class="shadow-none form-control" type="text" :class="{ 'form-input--error': $v.data.emergency_contact_person.$error }">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.birthday.$error }">Birthday</label>
                    <input v-model.trim="$v.data.birthday.$model" class="shadow-none form-control" type="date" :class="{ 'form-input--error': $v.data.birthday.$error }">
                </div>
                <div class="col-6">
                    <label class="">Middle Name</label>
                    <input v-model="data.middle_name" class="shadow-none form-control" type="text">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.contact_number.$error }">Contact Number</label>
                    <input v-model.number="$v.data.contact_number.$model" class="shadow-none form-control" type="number" :class="{ 'form-input--error': $v.data.contact_number.$error }">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.emergency_contact_number.$error }">Emergency Contact No.</label>
                    <input v-model="$v.data.emergency_contact_number.$model" class="shadow-none form-control" type="number" :class="{ 'form-input--error': $v.data.emergency_contact_number.$error }">
                   <label class="mt-1" :class="{ 'form-input-label--error': $v.data.address.$error }">Address</label>
                    <textarea v-model="$v.data.address.$model" class="shadow-none form-control" type="text" :class="{ 'form-input--error': $v.data.address.$error }"></textarea>
                </div>
            </div>
            <h5 class="mb-2 mt-3">Employment Info</h5>
            <div class="row">
                <div class="col-6">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.date_hired.$error }">Date Hired</label>
                    <input v-model.trim="$v.data.date_hired.$model" class="shadow-none form-control" type="date" :class="{ 'form-input--error': $v.data.date_hired.$error }">
                    <label class="" :class="{ 'form-input-label--error': $v.data.wage.$error }">Wage</label>
                    <input v-model.number="$v.data.wage.$model" class="shadow-none form-control" type="number" :class="{ 'form-input--error': $v.data.wage.$error }">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.holiday.$error }">Holiday</label>
                    <input v-model.number="$v.data.holiday.$model" class="shadow-none form-control" type="number" :class="{ 'form-input--error': $v.data.holiday.$error }">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.position_id.$error }">Position</label>
                    <select v-model="$v.data.position_id.$model" class="shadow-none form-select" :class="{ 'form-input--error': $v.data.position_id.$error }">
                        <option>Option</option>
                    </select>
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.work_policy_id.$error }">Work Policy Group</label>
                    <select v-model="$v.data.work_policy_id.$model" class="shadow-none form-select" :class="{ 'form-input--error': $v.data.work_policy_id.$error }">
                        <option>Option</option>
                    </select>
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.supervisor_id.$error }">Supervisor</label>
                    <select v-model="$v.data.supervisor_id.$model" class="shadow-none form-select" :class="{ 'form-input--error': $v.data.supervisor_id.$error }">
                        <option>Option</option>
                    </select>
                </div>
                <div class="col-6">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.overtime.$error }">Overtime</label>
                    <input v-model="$v.data.overtime.$model" class="shadow-none form-control" type="number" :class="{ 'form-input--error': $v.data.overtime.$error }">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.regular_holiday_rate.$error }">Regular Holiday Rate</label>
                    <input v-model="$v.data.regular_holiday_rate.$model" class="shadow-none form-control" type="number" :class="{ 'form-input--error': $v.data.regular_holiday_rate.$error }">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.status.$error }">Status</label>
                    <select v-model="$v.data.status.$model" class="shadow-none form-select" :class="{ 'form-input--error': $v.data.status.$error }">
                        <option disabled>Select Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Terminated</option>
                        <option>Resigned</option>
                        <option>Retired</option>
                    </select>
                   <label class="mt-1" :class="{ 'form-input-label--error': $v.data.over_time_policy_id.$error }">Overtime Policy</label>
                    <select v-model="$v.data.over_time_policy_id.$model" class="shadow-none form-select" :class="{ 'form-input--error': $v.data.over_time_policy_id.$error }">
                        <option>Option</option>
                    </select>
                   <label class="mt-1" :class="{ 'form-input-label--error': $v.data.branch_id.$error }">Branch</label>
                    <select v-model="$v.data.branch_id.$model" class="shadow-none form-select" :class="{ 'form-input--error': $v.data.branch_id.$error }">
                        <option>Option</option>
                    </select>
                </div>
            </div>
            <h5 class="mb-2 mt-4">Account Credentials</h5>
            <div class="row">
                <div class="col-6">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.email.$error }">Email Address</label>
                    <input v-model="$v.data.email.$model" class="shadow-none form-control" type="text" :class="{ 'form-input--error': $v.data.email.$error }">
                    <small v-if="!$v.data.email.email" :class="{ 'form-input-label--error': $v.data.email.$error }">Must be a valid email</small>
                </div>
                <div class="col-6">
                    <label class="mt-1" :class="{ 'form-input-label--error': $v.data.password.$error }">Password</label>
                    <input v-model="$v.data.password.$model" class="shadow-none form-control" type="password" :class="{ 'form-input--error': $v.data.password.$error }">
                </div>
            </div>
            <h5 class="mb-2 mt-4">Applicable Modules</h5>
            <div class="d-flex">
                <div class="form-check">
                  <input class="form-check-input" v-model="data.work_module" type="checkbox" id="workModules" >
                  <label class="form-check-label" for="workModules">
                    Work Modules
                  </label>
                </div>
                <div class="form-check ms-3">
                  <input class="form-check-input" v-model="data.human_resource" type="checkbox" id="humanResource" >
                  <label class="form-check-label" for="humanResource">
                    Human Resource
                  </label>
                </div>
                <div class="form-check ms-3">
                  <input class="form-check-input" v-model="data.sales_marketing" type="checkbox" id="salesAndMarketing" >
                  <label class="form-check-label" for="salesAndMarketing">
                    Sales and Marketing
                  </label>
                </div>
                <div class="form-check ms-3">
                  <input class="form-check-input" v-model="data.purchasing" type="checkbox" id="purchasing" >
                  <label class="form-check-label" for="purchasing">
                    Purchasing
                  </label>
                </div>
            </div>
            <div class="d-flex mt-1">
                <div class="form-check">
                  <input class="form-check-input" v-model="data.accounting" type="checkbox" id="accounting" >
                  <label class="form-check-label" for="accounting">
                    Accounting
                  </label>
                </div>
                <div class="form-check ms-3">
                  <input class="form-check-input" v-model="data.corporate_directory" type="checkbox" id="corporateDirectory" >
                  <label class="form-check-label" for="corporateDirectory">
                    Corporate Directory
                  </label>
                </div>
                <div class="form-check ms-3">
                  <input class="form-check-input" v-model="data.project_manager" type="checkbox" id="projectManager" >
                  <label class="form-check-label" for="projectManager">
                    Project Manager
                  </label>
                </div>
            </div>
             <h5 class="mb-2 mt-4">Account Type</h5>
             <div class="d-flex">
                <div class="form-check">
                  <input class="form-check-input" v-model="data.is_admin" type="checkbox" id="workModules" >
                  <label class="form-check-label" for="workModules">
                    Admin
                  </label>
                </div>
            </div>
            <hr class="mt-4 mb-1"/>
            <div class="d-flex justify-content-end mt-4 mb-2">
                <b-button variant="secondary" class="me-2" :disabled="isLoading"> Cancel </b-button>
                <b-button variant="success" :disabled="isLoading" type="submit">
                    Save Employee
                </b-button>
            </div>
          </form>
        </b-modal>
    </div>
</template>
<script>
import { required, email, maxLength, numeric } from 'vuelidate/lib/validators';

export default {
    data(){
        return {
            sort: 'asc',
            data: {
                email: '',
                password: '',
                first_name: '',
                middle_name: '',
                last_name: '',
                contact_number: '',
                address: '',
                birthday: '',
                emergency_contact_person: '',
                emergency_contact_number: '',
                supervisor_id:'',
                image: '',
                date_hired: '',
                wage: '',
                overtime: '',
                regular_holiday_rate: '',
                holiday: '',
                position_id: '',
                status: '',
                work_policy_id: '',
                branch_id: '',
                over_time_policy_id: '',
                work_module: false,
                human_resource: false,
                sales_marketing: false,
                accounting: false,
                purchasing: false,
                corporate_directory: false,
                project_manager: false,
                is_admin: false,
            }
        }
    },
    validations:{
        data: {
            email: {
                required, email
            },
            password: {
                required
            },
            first_name: {
                required
            },
            last_name: {
                required
            },
            contact_number: {
                required, numeric
            },
            emergency_contact_person: {
                required
            },
            address: {
                required
            },
            birthday: {
                required
            },
            emergency_contact_number: {
                required
            },
            date_hired: {
                required
            },
            wage: {
                required, numeric
            },
            overtime: {
                required, numeric
            },
            regular_holiday_rate: {
                required
            },
            holiday: {
                required, numeric
            },
            supervisor_id: {
                required
            },
            position_id: {
                required
            },
            status: {
                required
            },
            work_policy_id: {
                required
            },
            branch_id: {
                required
            },
            over_time_policy_id: {
                required
            },
        }
    },
    async mounted() {
        document.title = "Human Resource - Employee"
        this.initialLoading = true
        this.initialLoading = false
    },
    computed: {

    },
    methods: {
        saveEmployee(){
            this.$v.$touch()
            if(this.$v.$invalid) {
                this.$toast.error('Error! Required Fields are empty!')
                return
            }
            console.log('has proceeded')
        }
    },
    watch: {

    }
}
</script>