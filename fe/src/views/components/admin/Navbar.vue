<template>
 <div>
  <div class="navbar pt-3" :class="scrollpx >= 40 ? 'navbar-scrolled' : ''">
   <div class="d-flex me-auto ps-4" v-if="user.length != 0">
    <div class="d-flex flex-column justify-content-center">
     <h5 v-if="user.length != 0">
      <small>{{ user.info.first_name }} {{ user.info.last_name }}</small>
     </h5>
     <p v-if="user.length != 0" class="text-muted">
      <small>{{ user.role.role }}</small>
     </p>
    </div>
   </div>
   <div class="d-flex ms-auto pe-4">
    <div class="d-flex flex-column">
     <h5 class="align-self-end fw-light">
      <small>{{ date }}</small>
     </h5>
     <p class="align-self-end fw-bold">
      <small>{{ time }}</small>
     </p>
    </div>
   </div>
  </div>
 </div>
</template>
<script>
 import { mapActions, mapState } from 'vuex';
 import moment from 'moment';
 export default {
  components: {},
  data() {
   return {
    scrollpx: 0,
    date: '',
    time: '',
   };
  },
  async mounted() {
   await this.checkAuthUser();
   setInterval(() => {
    this.currentdate();
    this.currenttime();
   }, 1000);
  },
  computed: {
   ...mapState('auth', ['user']),
  },
  created() {
   window.addEventListener('scroll', this.handleScroll);
  },
  destroyed() {
   window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
   ...mapActions('auth', ['checkAuthUser']),
   handleScroll() {
    this.scrollpx = window.scrollY;
   },
   currentdate() {
    var a = new Date();
    this.date = moment(a).format(' MMMM D[,] YYYY');
   },
   currenttime() {
    var a = new Date();
    this.time = moment(a).format('hh:mm A');
   },
  },
 };
</script>
