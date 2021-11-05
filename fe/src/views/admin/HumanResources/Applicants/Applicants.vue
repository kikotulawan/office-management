<template>
 <div>
  <div class="container-fluid">
   <Tabs :hidden="this.$route.params.slug > 0" />
   <router-view name="allapplicants" />
   <router-view name="initialscreening" />
   <router-view name="finalscreening" />
   <router-view name="viewapplicant" />
   <router-view name="newapplicant" />
   <router-view name="interviewapplicant" />
   <router-view name="interview" />
   <router-view name="onboarding" />
  </div>
 </div>
</template>
<script>
 import Tabs from '../../../components/admin/HumanResources/Tabs.vue';
 export default {
  components: { Tabs },
  computed: {
   getRoute: function() {
    return this.$route.path;
   },
  },
 };
</script>
