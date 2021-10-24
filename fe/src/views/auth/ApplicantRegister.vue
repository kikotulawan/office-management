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
              <input v-model="data.password" type="password" class="form-control shadow-none" id="login-password" aria-describedby="basic-addon2">
            </div>
          </div>
          <div v-if="registrationStep == 2">
            <label for="login-email" class="form-label"><small>First Name</small></label>
            <div class="input-group mb-2">
              <input v-model="data.first_name" type="text" class="form-control shadow-none" id="firstname" aria-describedby="basic-addon1">
            </div>
            <label for="middlename" class="form-label"><small>Middle Name</small></label>
            <div class="input-group mb-1">
              <input v-model="data.middle_name" type="text" class="form-control shadow-none" id="middlename" aria-describedby="basic-addon2">
            </div>
            <label for="lastname" class="form-label"><small>Last Name</small></label>
            <div class="input-group mb-1">              
              <input v-model="data.last_name" type="text" class="form-control shadow-none" id="lastname" aria-describedby="basic-addon2">
            </div>
            <label for="contactnumber" class="form-label"><small>Contact Number</small></label>
            <div class="input-group mb-1">
              <input v-model="data.contact_number" type="text" class="form-control shadow-none" id="contactnumber" aria-describedby="basic-addon2">
            </div>
          </div>
          <div v-if="registrationStep == 3">
            <label for="gender" class="form-label"><small>Gender</small></label>
            <div class="input-group mb-2">
              <select v-model="data.gender" type="text" class="form-select shadow-none" id="gender" aria-describedby="basic-addon1">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <label for="address" class="form-label"><small>Address</small></label>
            <div class="input-group mb-1">
              <textarea v-model="data.address" type="text" class="form-control shadow-none" id="address" aria-describedby="basic-addon2"></textarea>
            </div>
            <label for="age" class="form-label"><small>Age</small></label>
            <div class="input-group mb-1">
              <input v-model="data.age" type="number" class="form-control shadow-none" id="age" aria-describedby="basic-addon2">
            </div>
            <label for="birthday" class="form-label"><small>Birthday</small></label>
            <div class="input-group mb-1">
              <input v-model="data.birthday" type="date" class="form-control shadow-none" id="birthday" aria-describedby="basic-addon2">
            </div>
          </div>
          <div v-if="registrationStep == 4">
            <label for="emergencycontactperson" class="form-label"><small>Emergency Contact Person</small></label>
            <div class="input-group mb-1">
              <input v-model="data.emergency_contact_person" type="text" class="form-control shadow-none" id="emergencycontactperson" aria-describedby="basic-addon2">
            </div>
            <label for="emergencycontactnumber" class="form-label"><small>Emergency Contact Number</small></label>
            <div class="input-group mb-1">
              <input v-model="data.emergency_contact_number" type="text" class="form-control shadow-none" id="emergencycontactnumber" aria-describedby="basic-addon2">
            </div>
          </div>
          <div class="d-grid mt-3">
            <button :disabled="isLoading" href="" class="mt-2 btn rounded-3 btn-primary shadow-none" v-on:click.prevent="registrationStep--" v-if="registrationStep != 1">
                Prev
            </button>
            <button :disabled="isLoading" href="" class="mt-2 btn rounded-3 btn-primary shadow-none" v-on:click.prevent="checkRegistration" >
                {{registrationStep == 4 ? 'Register' : 'Next'}}
            </button>
            <small class="text-center mt-2">Already have an account? <router-link class="text-decoration-none" to="/jobs/applicant/login">Login</router-link></small>
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
        first_name: '',
        middle_name: '',
        last_name: '',
        contact_number: '',
        gender: '',
        age: '',
        address: '',
        birthday: '',
        emergency_contact_person: '',
        emergency_contact_number: '', 
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
        if(this.data.middle_name.trim() == '') return this.$toast.error('Middle name is required')
        if(this.data.last_name.trim() == '') return this.$toast.error('Last name is required')
        if(this.data.contact_number == '') return this.$toast.error('Contact number is required')

        this.registrationStep++;
      }

      if(this.registrationStep == 3){
        if(this.data.gender == '') return this.$toast.error('Gender is required')
        if(this.data.address == '') return this.$toast.error('Address is required')
        if(this.data.age == '') return this.$toast.error('Age is required')
        if(this.data.birthday == '') return this.$toast.error('Birthday is required')

        this.registrationStep++;
      }

      if(this.registrationStep == 4){
        if(this.data.emergency_contact_person == '') return this.$toast.error('Emergency Contact Person is required')
        if(this.data.emergency_contact_number == '') return this.$toast.error('Emergency Contact Number is required')

        this.$bvModal.show('registrationModal')
      }
    },
    async saveApplicant(){
     this.$bvModal.hide('registrationModal')

     const {status} = await this.$store.dispatch('auth/applicantRegister', this.data)
     if(status == 200) { 
       this.$toast.success('Account created successfully!')
       this.$router.push('/applicant/home/profile')
       this.clearData()
     }
     else {
       this.$toast.error('Account creation failed!')
     }
    },
    validEmail(){
      let regEx = /^([a-z0-9_\-.])+@([a-z0-9_\-.])+\.([a-z0-9]{2,})$/gi
      let isEmail = regEx.test(this.data.email)
      return isEmail
    },
    clearData(){
      this.data.email = ''
      this.data.password = ''
      this.data.first_name = ''
      this.data.middle_name = ''
      this.data.last_name = ''
      this.data.gender = ''
      this.data.age = ''
      this.data.address = ''
      this.data.birthday = ''
      this.data.contact_number = ''
    }
  }
}
</script>