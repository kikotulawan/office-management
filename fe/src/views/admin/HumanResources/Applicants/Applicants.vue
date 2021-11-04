<template>
  <div>
    <div class="container-fluid">
      <Tabs/>
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
import Tabs from '../../../components/admin/HumanResources/Tabs.vue'
export default {
  components: {Tabs},
  
}
</script>
