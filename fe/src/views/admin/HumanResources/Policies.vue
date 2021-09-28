<template>
    <div>
       <div class="container-fluid">
        <div class="card p-5 mt-3 mb-5">
            <h5 class="mt-1">Work Policy</h5>
            <p class="text-muted">Listed below are your policy</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm shadow-none" @click="$bvModal.show('addPolicyModal')"> <i class="bi bi-plus"></i>Add  Policy</button>
            </div>
            <b-skeleton-table
                :rows="5"
                :columns="4"
                :table-props="{ bordered: true, striped: false }"
                class="mt-4"
                v-if="initialLoading"
                ></b-skeleton-table>
            <table class="table table-striped table-hover mt-4" v-else>
                <caption>Showing {{policies.from}} to {{policies.to}} of {{policies.total}} data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Name <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                    <th scope="col">Schedule</th>
                    <th scope="col">Deducted Hours</th>
                    <th scope="col">Grace Period</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(policy, i) in policies.data" :key="i">
                        <td scope="row">{{policies.from + i}}</td>
                        <td>{{policy.policy_name}}</td>
                        <td>
                            <a href="" type="button" class="text-decoration-none" @click.prevent="work_schedule = policy.policydays; $bvModal.show('workScheduleModal')">Show Schedule</a>
                        </td>
                        <td>{{policy.deducted_hours}}</td>
                        <td>{{policy.grace_period}}</td>
                        <td>
                            <a v-on:click.prevent="$bvModal.show()" href="" class="btn btn-secondary btn-sm rounded-pill shadow-none me-2" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a v-on:click.prevent="delete_data.id = policy.id; $bvModal.show('deletePolicyModal')" href="" class="btn btn-danger btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--- INITIAL CONFIGURATION FOR PAGINATION -->
            <!--- TO-DO -->
            <!--- 1. SEARCH FUNCTIONALITY  -->
            <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
            <div class="row mt-3" v-if="policies.data">
              <pagination :showDisabled="true" :align="'right'" :data="policies" @pagination-change-page="getPolicies">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div>
        </div>
        <div class="card p-5 mt-3 mb-5">
            <h5 class="mt-1">Overtime Policy</h5>
            <p class="text-muted">Listed below are your overtime policy</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm shadow-none" @click="$bvModal.show('addOvertimePolicyModal')"> <i class="bi bi-plus"></i>Overtime Policy</button>
            </div>
            <b-skeleton-table
                :rows="5"
                :columns="4"
                :table-props="{ bordered: true, striped: false }"
                class="mt-4"
                v-if="initialLoading"
                ></b-skeleton-table>
            <table class="table table-striped table-hover mt-4" v-else>
                <caption>Showing {{policies.from}} to {{policies.to}} of {{policies.total}} data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Name <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                    <th scope="col">Start Time</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(policy, i) in policies.data" :key="i">
                        <td scope="row">{{policies.from + i}}</td>
                        <td>{{policy.policy_name}}</td>
                        <td>{{policy.address}}</td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="" class="btn btn-danger btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--- INITIAL CONFIGURATION FOR PAGINATION -->
            <!--- TO-DO -->
            <!--- 1. SEARCH FUNCTIONALITY  -->
            <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
            <div class="row mt-3" v-if="policies.data">
              <pagination :showDisabled="true" :align="'right'" :data="policies" @pagination-change-page="getPolicies">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div>
        </div>
       </div>

       <b-modal id="addPolicyModal" scrollable centered title="Add Policy">
          <form ref="policyform" class="p-2">
            <label class="">Policy Name</label>
            <input v-model="data.policy_name" class="form-control" type="text">
            <div v-for="(sched, index) in data.time_schedule" :key="index">
                <label class="mt-2">Time Schedule</label>
                <div class="col-12">
                <date-picker
                    v-model="sched.time"
                    :time-picker-options="{
                        start: '00:00',
                        step: '01:00',
                        end: '24:00',
                    }"
                    value-type="format"
                    format="hh:mm a"
                    type="time"
                    placeholder="hh:mm a - hh:mm a"
                    class="w-100"
                    range
                    ></date-picker>
                </div>
                <label class="mt-2">Apply to</label>
                <select v-model="sched.days" class="form-select" size="5"  multiple aria-label="multiple select day">
                    <option :value="day.value" v-for="(day, i) in days" :key="i" @click.prevent="log(index)">{{day.text}}</option>
                </select>
            </div>
            
            <div class="d-flex justify-content-end">
                <a @click.prevent="addSchedule" href="" class="text-decoration-none mt-2">Add Schedule</a>
            </div>
            <label class="mt-1">Grace Period</label>
            <input v-model="data.grace_period" class="form-control" placeholder="per minutes" type="text">
            <label class="mt-1">Deducted Hours</label>
            <input v-model="data.deducted_hours" class="form-control" placeholder="per hour" type="text">
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="savePolicy" :disabled="isLoading">
                Save Policy
            </b-button>
            </template>
        </b-modal>

       <b-modal id="addOvertimePolicyModal" centered title="Add Overtime">
          <form ref="policyform" class="p-2">
            <label class="">Overtime Policy</label>
            <input v-model="overtime.name" class="form-control" type="text">
            <label class="mt-2">Start Time</label>
            <div class="d-block">
                <date-picker class="w-100" v-model="overtime.start" format="hh:mm a" type="time"></date-picker>
            </div>
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="saveBranch" :disabled="isLoading">
                Save Policy
            </b-button>
            </template>
        </b-modal>


       <b-modal id="deletePolicyModal" centered title="Delete Work Policy">
          <p>Are you sure you want to delete this policy?</p>
          <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="deleteWorkPolicy" :disabled="isLoading">
                Delete Policy
            </b-button>
          </template>
        </b-modal>

       <b-modal id="workScheduleModal" centered title="Work Schedule">
          <div v-for="(sched, i) in work_schedule" :key="i" class="d-flex flex-column mt-1 ">
              <p>{{returnDay(sched.day)}}</p>
              <p>{{sched.time_start}} - {{sched.time_end}}</p>
          </div>
          <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()"> Close </b-button>
          </template>
        </b-modal>
    </div>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data(){
        return {
            data: {
                policy_name: '',
                time_schedule: [
                    {
                        days: [],
                        time: [],
                    }
                ],
                grace_period: '',
                deducted_hours: '',
            },
            overtime: {
                    
            },
            days: [
                    {
                        value: 0,
                        text: 'Sunday',
                    },
                    {
                        value: 1,
                        text: 'Monday',
                    },
                    {
                        value: 2,
                        text: 'Tuesday',
                    },
                    {
                        value: 3,
                        text: 'Wednesday',
                    },
                    {
                        value: 4,
                        text: 'Thursday',
                    },
                    {
                        value: 5,
                        text: 'Friday',
                    },
                    {
                        value: 6,
                        text: 'Saturday',
                    },
            ],
            selectedDays: [],
            work_schedule: [],
            sort: 'asc',
            modalId: '',
            prevIndex: '',
        }
    },
    async mounted() {
        this.initialLoading = true
        document.title = 'Human Resource - Policies'
        await this.$store.dispatch('auth/checkUser')
        await this.$store.dispatch('policies/getPolicies', {page: 1, sort: this.sort})
        this.$root.$on('bv::modal::show', (modalId) => {
            this.modalId = modalId.componentId
        })
        this.$root.$on('bv::modal::hide', (modalId) => {
            this.data.policy_name = ''
            this.data.deducted_hours = ''
            this.data.grace_period = ''
            this.data.time_schedule = [{days: [], time: []}]
            this.prevIndex = '',
            this.selectedDays = []
            this.days = [
                    {
                        value: 0,
                        text: 'Sunday',
                    },
                    {
                        value: 1,
                        text: 'Monday',
                    },
                    {
                        value: 2,
                        text: 'Tuesday',
                    },
                    {
                        value: 3,
                        text: 'Wednesday',
                    },
                    {
                        value: 4,
                        text: 'Thursday',
                    },
                    {
                        value: 5,
                        text: 'Friday',
                    },
                    {
                        value: 6,
                        text: 'Saturday',
                    },
            ]
        })
        this.initialLoading = false
    },
    computed: {
        ...mapState('policies', ['policies']),
    },
    methods: {
        log(index){
            // this.$nextTick(function (){
            //     this.$set(this.selectedDays, index, {...this.data.time_schedule[index].days})
            // })
            this.selectedDays.splice(index, 1, {...this.data.time_schedule[index].days})
            
        },
       returnDay(day){
           let data = [
               'Sunday',
               'Monday',
               'Tuesday',
               'Wednesday',
               'Thursday',
               'Friday',
               'Saturday',
           ] 
           
           return data[day]
       },
       addSchedule(){
           this.data.time_schedule.push({days: [], time: []})
       },
       async getPolicies(page = 1){
         await this.$store.dispatch('policies/getPolicies', {page: page, sort: this.sort})
       },
       async updatePolicy(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the branch is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('policies/updatePolicy', this.data)
           this.checkStatus(data, status, 'update')
       },
       async deleteWorkPolicy(){
           this.isLoading = true
           const { data, status } = await this.$store.dispatch('policies/deletePolicy', this.delete_data)
           this.checkStatus(data, status, '')
       },
       async savePolicy(){
           if(this.data.policy_name.trim() == '') return this.$toast.error('Policy name is required')
           if(this.data.deducted_hours == '') return this.$toast.error('Deducted Hours is required')
           
           this.isLoading = true

           const { data, status } = await this.$store.dispatch('policies/savePolicy', this.data)
           this.checkStatus(data, status, '', 'policies/getPolicies')
       },
       closeModal(){
           this.$bvModal.hide(this.modalId)
       }
    },
    watch: {
        sort(){
            this.getBranches()
        },
        // 'data.time_schedule': function (newVal, oldVal){
        //     let days = [];
            
        //     this.data.time_schedule.forEach((element, selectedDayIndex) => {
   
        //         days = [...this.days[selectedDayIndex]];
        //         this.days.forEach((el, i) => {
        //             this.data.time_schedule[i].days.forEach((sd, slindex) => {
                    
        //             // console.log(days)
        //             // console.log(this.data.time_schedule[selectedDayIndex].days[slindex])
        //             days.forEach((el, dayIndex) => {
        //                     if(days[dayIndex].value == this.data.time_schedule[selectedDayIndex].days[slindex]){
        //                         // console.log(days[dayIndex].value)
        //                         // console.log(this.data.time_schedule[selectedDayIndex].days[slindex])
        //                         days.splice(dayIndex, 1)
        //                         console.log(days)
        //                     }
        //                 })
        //             })
        //         })

        //         this.days.push(days)
        //     });
        //     // console.log(days)
            

        //     // this.selectedDays.forEach((element, selectedDayIndex) => {
        //     //     days = [];
        //     //     this.days.forEach((el, i) => {
        //     //         this.selectedDays[i].forEach((sd, slindex) => {
        //     //         days = [...this.days[i]];
        //     //         console.log(this.days[i])
        //     //         this.days[i].forEach((el, dayIndex) => {
        //     //                 if(this.days[i][dayIndex].value == this.selectedDays[selectedDayIndex][slindex]){
        //     //                     days.splice(dayIndex, 1)
        //     //                 }
        //     //             })
        //     //         })
        //     //     })
        //     // });

        //     // console.log(days)
        //     // this.days.push(days)
        // }   
    }
}
</script>

