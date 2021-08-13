<template>
  <div class="dashboard-editor-container">
    <el-alert
      v-if="membership.status === 'NONE' && loaded"
      title="You Have No Membership Application"
      type="error"
      description="Please fill up a membership application form to proceed."
      show-icon
      :closable="false"
    />
    <el-alert
      v-if="membership.status === 'PENDING' && loaded"
      title="Your Membership Application is under review."
      type="warning"
      description="We are currently reviewing your membership application."
      show-icon
      :closable="false"
    />
    <el-alert
      v-if="membership.status === 'APPROVED' && loaded"
      title="Your Membership Application is approved."
      type="success"
      description="You may view your member dashboard.."
      show-icon
      :closable="true"
    />
    <panel-group
      :membership="membership"
      :loaded="loaded"
      @getMembershipData="updateUserDashboard"
    />
  </div>
</template>

<script>
import PanelGroup from './components/PanelGroup';

import Resource from '@/api/resource';
const membershipResource = new Resource('membership');

export default {
  name: 'UserDashboard',
  components: {
    PanelGroup,
  },
  data() {
    return {
      membership: {
        status: 'NONE',
      },
      loaded: false,
    };
  },
  watch: {
    $route(to, from) {
      if (to.name === 'Dashboard'){
        this.getMembershipStatus();
      }
    },
  },
  created(){
    this.getMembershipStatus();
  },
  methods: {
    async getMembershipStatus() {
      const { data } = await membershipResource.list({});
      this.membership = data[0];
      this.loaded = true;
      console.log(this.membership);
    },
    updateUserDashboard(data) {
      console.log(data);
      this.membership = data;
      this.loaded = true;
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.dashboard-editor-container {
  padding: 32px;
  background-color: rgb(240, 242, 245);
  .chart-wrapper {
    background: #fff;
    padding: 16px 16px 0;
    margin-bottom: 32px;
  }
}
</style>
