<template>
 <div>
  <h1>This is the pay-periods</h1>
  <h1>
   This is the pay-periodsThis is the pay-periodsThis is the pay-periodsThis is the pay-periodsThis is the pay-periodsThis is the pay-periodsThis is the pay-periodsThis is the pay-periodsThis is the pay-periodsThis is the pay-periodsThis is the
   pay-periods
  </h1>
 </div>
</template>
<script>
 export default {
  data() {
   return {};
  },
  async mounted() {
   await this.$store.dispatch('auth/checkAuthUser');
  },
  computed: {},
  methods: {},
  watch: {},
 };
</script>
