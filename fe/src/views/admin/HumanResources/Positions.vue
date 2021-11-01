<template>
    <div>
       <div class="container-fluid">
        <div class="card p-5 mt-3 mb-5">
            <h5 class="mt-1">Positions</h5>
            <p class="text-muted">Manage the positions below</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm" @click="$bvModal.show('addPositionModal')"> <i class="bi bi-plus"></i>Add Position</button>
            </div>
            <h5 class="text-center mt-5"  v-if="positions.data.length == 0 && !initialLoading">No positions found on the database</h5>
            <b-skeleton-table
                :rows="5"
                :columns="4"
                :table-props="{ bordered: true, striped: true }"
                class="mt-4"
                v-if="initialLoading"
                ></b-skeleton-table>
            <table class="table table-striped table-hover mt-4" v-else>
                <caption>Showing {{positions.from}} to {{positions.to}} of {{positions.total}} data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Name <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(pos, i) in positions.data" :key="i">
                        <td scope="row">{{positions.from + i}}</td>
                        <td class="text-nowrap">{{pos.name}}</td>
                        <td>{{pos.description}}</td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm rounded-pill" @click.prevent="data = {...pos}; $bvModal.show('updatePositionModal')">
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
            <div class="row mt-3" v-if="positions.data">
              <pagination :showDisabled="true" :align="'right'" :data="positions" @pagination-change-page="getPositions">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div>
        </div>
       </div>

       <b-modal id="addPositionModal" centered title="Add Position">
          <form ref="positionform" class="p-2">
            <label class="">Name</label>
            <input v-model="data.name" class="form-control" type="text">
            <label class="">Description</label>
            <textarea v-model="data.description" class="form-control" type="text"></textarea>
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="savePosition" :disabled="isLoading">
                Save Position
            </b-button>
            </template>
        </b-modal>

       <b-modal id="updatePositionModal" centered title="Update Position">
          <form ref="positionform" class="p-2">
            <label class="">Name</label>
            <input v-model="data.name" class="form-control" type="text">
            <label class="">Description</label>
            <textarea v-model="data.description" class="form-control" type="text"></textarea>
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="updatePosition" :disabled="isLoading">
                Update Position
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
                description: '',
            },
            sort: 'asc',
            modalId: '',
        }
    },
    created(){
        document.title = 'Human Resource - Positions'
    },
    async mounted() {
        await this.$store.dispatch('auth/checkAuthUser')    
        this.initialLoading = true
        await this.$store.dispatch('position/getPositions', {page: 1, sort: this.sort})
        this.$root.$on('bv::modal::show', (modalId) => {
            this.modalId = modalId.componentId
        })
        this.$root.$on('bv::modal::hide', (modalId) => {
            this.data.name = ''
            this.data.description = ''
        })
        this.initialLoading = false
    },
    computed: {
        ...mapState('position', ['positions'])
    },
    methods: {
       async getPositions(page = 1){
         await this.$store.dispatch('position/getPositions', {page: page, sort: this.sort})
       },
       async updatePosition(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the position is required')
           if(this.data.description.trim() == '') return this.$toast.error('Description for the position is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('position/updatePosition', this.data)
           this.checkStatus(data, status, 'update')
       },
       async savePosition(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the position is required')
           if(this.data.description.trim() == '') return this.$toast.error('Description for the position is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('position/savePosition', this.data)
           this.checkStatus(data, status, '', 'position/getPositions')
       },
       closeModal(){
           this.data.name = ''
           this.data.description = ''
           this.$bvModal.hide(this.modalId)
       }
    },
    watch: {
        sort(){
            this.getPositions()
        }
    }
}
</script>

