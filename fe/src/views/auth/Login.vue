<template>
  <div class="login-page">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
      <div class="card login-card rounded-0">
        <div class="card-body p-5">
          <p class="fs-1 mb-3 text-center">e<span class="fw-bold">Office</span></p>
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
          <div class="mb-3">
            <a href="" class="text-decoration-none"><small>Forgot password?</small></a>
          </div>
          <div class="d-grid">
            <button :disabled="isLoading" href="" class="mt-3 btn rounded-3 btn-primary shadow-none" v-on:click.prevent="signin" >
                Login Account
              <div v-if="isLoading" class="spinner-grow text-light spinner-grow-sm me-2 text-center" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </button>
            <router-link to="/jobs/applicant/login" class="text-center mt-2 text-decoration-none">Go to applicant portal</router-link>
          </div>
        </div>
      </div>
    </div>
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
      isLoading: false
    }
  },
  mounted(){
    document.title = "Welcome to eOffice! Please login"
  },
  components: {
  },
  methods: {
    ...mapActions('auth', ['loginUserAccount']),
    async signin(){ 
      if(this.data.email == '') return this.$toast.error('Email is required');
      if(this.data.password == '') return this.$toast.error('Password is required');
      if(!this.validEmail()) return this.$toast.error('Email is invalid');
      this.isLoading = true
        const res = await this.loginUserAccount(this.data)
        if(res == 'Error: Network Error'){
          this.$toast.error('Our server is currently down at this time.')
        }

        if(res.status == 200){
          this.$router.push(`${res.data.route}`)
          this.$toast.success(`Welcome, ${res.data.user_info.first_name} ${res.data.user_info.last_name}`)
        }
        else{
          this.$toast.error('Incorrect credentials')
          this.isLoading = false
        }
        
        this.isLoading = false
    },
    validEmail(){
      let regEx = /^([a-z0-9_\-.])+@([a-z0-9_\-.])+\.([a-z0-9]{2,})$/gi
      let isEmail = regEx.test(this.data.email)
      return isEmail
    },
  }
}
</script>