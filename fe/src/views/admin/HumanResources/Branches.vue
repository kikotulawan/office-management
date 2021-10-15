<template>
    <div>
       <div class="container-fluid">
        <div class="card p-5 mt-3 mb-5">
            <h5 class="mt-1">Branches</h5>
            <p class="text-muted">Manage the branches below</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm shadow-none" @click="$bvModal.show('addBranchModal')"> <i class="bi bi-plus"></i>Add Branch</button>
            </div>
            <h5 class="text-center mt-5"  v-if="branches.data.length == 0 && !initialLoading">No branches found on the database</h5>
            <b-skeleton-table
                :rows="7"
                :columns="6"
                :table-props="{ bordered: true, striped: true }"
                class="mt-4"
                v-if="initialLoading"
                ></b-skeleton-table>
            <table class="table table-striped table-hover mt-4" v-if="branches.data.length > 0">
                <caption>Showing {{branches.from}} to {{branches.to}} of {{branches.total}} data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Name <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Person in Charge</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(branch, i) in branches.data" :key="i">
                        <td scope="row">{{branches.from + i}}</td>
                        <td>{{branch.name}}</td>
                        <td>{{branch.address}}</td>
                        <td>{{branch.contact_number}}</td>
                        <td>{{branch.person_in_charge}}</td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--- INITIAL CONFIGURATION FOR PAGINATION -->
            <!--- TO-DO -->
            <!--- 1. SEARCH FUNCTIONALITY  -->
            <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
            <div class="row mt-3" v-if="branches.data">
              <pagination :showDisabled="true" :align="'right'" :data="branches" @pagination-change-page="getBranches">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div>
        </div>
       </div>

       <b-modal id="addBranchModal" centered title="Add Branch">
          <form ref="branchform" class="p-2">
            <label class="">Name</label>
            <input v-model="data.name" class="shadow-none form-control" type="text">
            <label class="">Address</label>
            <textarea v-model="data.address" class="shadow-none form-control" type="text"></textarea>
            <label class="">Contact Number</label>
            <input v-model="data.contact_number" class="shadow-none form-control" type="number">
            <label class="">Person in Charge</label>
            <select v-model="data.person_in_charge" class="shadow-none form-select">
                <option value="Administrator">Administrator</option>
            </select>
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="saveBranch" :disabled="isLoading">
                Save Branch
            </b-button>
            </template>
        </b-modal>

       <b-modal id="updateBranchModal" centered title="Update Branch">
          <form ref="branchform" class="p-2">
            <label class="">Name</label>
            <input v-model="data.name" class="shadow-none form-control" type="text">
            <label class="">Address</label>
            <textarea v-model="data.address" class="shadow-none form-control" type="text"></textarea>
            <label class="">Contact Number</label>
            <input v-model="data.contact_number" class="shadow-none form-control" type="number">
            <label class="">Person in Charge</label>
            <select v-model="data.person_in_charge" class="shadow-none form-select">
                <option value="Administrator">Administrator</option>
            </select>
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="updateBranch" :disabled="isLoading">
                Update Branch
            </b-button>
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
                name: '',
                address: '',
                contact_number: '',
                person_in_charge: '',
            },
            sort: 'asc',
            modalId: '',
        }
    },
    async mounted() {
        this.initialLoading = true
        document.title = 'Human Resource - Branches'
        await this.$store.dispatch('branches/getBranches', {page: 1, sort: this.sort})
        this.$root.$on('bv::modal::show', (modalId) => {
            this.modalId = modalId.componentId
        })
        this.$root.$on('bv::modal::hide', (modalId) => {
            this.data.name = ''
            this.data.address = ''
            this.data.contact_number = ''
            this.data.person_in_charge = ''
        })
        this.initialLoading = false
    },
    computed: {
        ...mapState('branches', ['branches']),
    },
    methods: {
       async getBranches(page = 1){
         await this.$store.dispatch('branches/getBranches', {page: page, sort: this.sort})
       },
       async updateBranch(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the branch is required')
           if(this.data.address.trim() == '') return this.$toast.error('Address for the branch is required')
           if(this.data.contact_number.trim() == '') return this.$toast.error('Contact for the branch is required')
           if(this.data.person_in_charge.trim() == '') return this.$toast.error('Person in charge of the branch is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('branches/updateBranch', this.data)
           this.checkStatus(data, status, 'update')
       },
       async saveBranch(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the branch is required')
           if(this.data.address.trim() == '') return this.$toast.error('Address for the branch is required')
           if(this.data.contact_number.trim() == '') return this.$toast.error('Contact for the branch is required')
           if(this.data.person_in_charge.trim() == '') return this.$toast.error('Person in charge of the branch is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('branches/saveBranch', this.data)
           this.checkStatus(data, status, '', 'branches/getBranches')
       },
       closeModal(){
           this.data.name = ''
           this.data.address = ''
           this.data.contact_number = ''
           this.data.person_in_charge = ''
           this.$bvModal.hide(this.modalId)
       }
    },
    watch: {
        sort(){
            this.getBranches()
        }
    }
}
</script>

