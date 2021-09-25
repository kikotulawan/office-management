<template>
    <div>
       <div class="container-fluid">
        <div class="card p-5 mt-3 mb-5">
            <h5 class="mt-1">Job Opening</h5>
            <p class="text-muted">Manage all job opening below</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm shadow-none" @click="$bvModal.show('addBranchModal')"> <i class="bi bi-plus"></i>Add Job Opening</button>
            </div>
            <table class="table table-striped table-hover mt-4">
                <caption>Showing 0 to 0 of 0 data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Job Title</th>
                    <th scope="col">Date Posted</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>Makati Branch</td>
                        <td>HR Officer</td>
                        <td>September 3, 2021</td>
                        <td>PHP 13K - 16K monthly</td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm rounded-pill shadow-none me-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="" class="btn btn-primary btn-sm rounded-pill shadow-none">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--- INITIAL CONFIGURATION FOR PAGINATION -->
            <!--- TO-DO -->
            <!--- 1. SEARCH FUNCTIONALITY  -->
            <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
        </div>
       </div>
    </div>
</template>
<script>
export default {
    data(){
        return {

        }
    },
    async mounted() {

    },
    computed: {

    },
    methods: {

    },
    watch: {

    }
}
</script>