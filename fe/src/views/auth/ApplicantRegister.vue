<template>
  <div class="login-page">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
      <div class="card login-card rounded-0">
        <div class="card-body p-5">
         <h5>Applicant Register</h5>
          <p class="mb-3 mt-2">Welcome, We need some of your information.</p>
          <div v-if="registrationStep == 1">
            <label for="login-email" class="form-label"><small>Email Address</small></label>
            <div class="input-group mb-2">
              <span class="input-group-text bg-white" id="basic-addon1"><i class="bi bi-person-fill fs-5"></i></span>
              <input v-model="data.email" type="email" class="form-control shadow-none" id="login-email" aria-describedby="basic-addon1" autocomplete="off" autofocus>
            </div>
             <label for="login-password" class="form-label"><small>Password</small></label>
            <div class="input-group mb-1">
              <span class="input-group-text bg-white border-end-0" id="basic-addon2"><i class="bi bi-shield-lock-fill fs-5"></i></span>
              <input v-model="data.password" type="password" class="form-control shadow-none" id="login-password" aria-describedby="basic-addon2" v-on:keyup.enter="signin">
            </div>
          </div>
          <div v-if="registrationStep == 2">
            <label for="login-email" class="form-label"><small>First Name</small></label>
            <div class="input-group mb-2">
              <input v-model="data.first_name" type="text" class="form-control shadow-none" id="firstname" aria-describedby="basic-addon1" autocomplete="off" autofocus>
            </div>
            <label for="lastname" class="form-label"><small>Last Name</small></label>
            <div class="input-group mb-1">
              <input v-model="data.last_name" type="text" class="form-control shadow-none" id="lastname" aria-describedby="basic-addon2" v-on:keyup.enter="signin">
            </div>
            <label for="contactnumber" class="form-label"><small>Contact Number</small></label>
            <div class="input-group mb-1">
              <input v-model="data.contact_number" type="text" class="form-control shadow-none" id="contactnumber" aria-describedby="basic-addon2" v-on:keyup.enter="signin">
            </div>
          </div>
          <div class="d-grid mt-3">
            <button :disabled="isLoading" href="" class="mt-2 btn rounded-3 btn-primary shadow-none" v-on:click.prevent="checkRegistration" >
                {{registrationStep == 2 ? 'Register' : 'Next'}}
            </button>
            <small class="text-center mt-2">Already have an account? <router-link class="text-decoration-none" to="/applicant/login">Login</router-link></small>
          </div>
        </div>
      </div>
    </div>
    <b-modal id="registrationModal" centered title="Confirm Registration">
     <p>You'll still need to add additional details as soon as you create your account. Do you wish to proceed?</p>
      <template #modal-footer = {cancel} >
         <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
         <b-button variant="success" v-on:click.prevent="saveApplicant" :disabled="isLoading">
             Proceed
         </b-button>
       </template>
    </b-modal>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
  name: 'Login',
  data(){
    return {
      data: {
        email: '',
        password: '',
      },
      isLoading: false,
      registrationStep: 1,
    }
  },
  mounted(){
    document.title = "Welcome to eOffice! Please login"
  },
  components: {
  },
  methods: {
    ...mapActions('auth', ['applicantLogin']),
    async checkRegistration(){ 
      if(this.registrationStep == 1){
       if(this.data.email.trim() == '') return this.$toast.error('Email address is required')
       if(!this.validEmail()) return this.$toast.error('Email address is invalid')
       if(this.data.password.trim() == '') return this.$toast.error('Password is required')

       this.registrationStep++;
      }

      if(this.registrationStep == 2){
        if(this.data.first_name.trim() == '') return this.$toast.error('First name is required')
        if(this.data.last_name.trim() == '') return this.$toast.error('Last name is required')
        if(this.data.contact_number == '') return this.$toast.error('Contact number is required')

        this.$bvModal.show('registrationModal')
      }
    },
    async saveApplicant(){
     this.$bvModal.hide('registrationModal')
    },
    validEmail(){
      let regEx = /^([a-z0-9_\-.])+@([a-z0-9_\-.])+\.([a-z0-9]{2,})$/gi
      let isEmail = regEx.test(this.data.email)
      return isEmail
    },
  }
}
</script>