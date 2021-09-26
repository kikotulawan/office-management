<template>
    <div>
        <div class="human-resources-content">
          <div class="container-fluid">
            <Tabs />
              <router-view name="branches"/>
              <router-view name="departments"/>
              <router-view name="positions"/>
              <router-view name="employees"/>
              <router-view name="applicants"/>
              <router-view name="jobopening"/>
              <router-view name="holidays"/>
              <router-view name="breaks"/>
              <router-view name="memos"/>
              <router-view name="policies"/>
              <router-view name="payperiods"/>
              <router-view name="leaves"/>
            </div>
        </div>
    </div>
</template>
<script>
import Tabs from '../components/admin/HumanResources/Tabs.vue'
export default {
    components: {Tabs}
}
</script>