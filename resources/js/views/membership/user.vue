<template>
  <div v-loading="loading" class="app-container">
    <view-membership v-if="checkRole(['user'])" />
    <membership-list v-if="checkRole(['admin'])" />
  </div>
</template>

<script>
import checkRole from '@/utils/role'; // Role checking

import ViewMembership from './view.vue';
import MembershipList from './index.vue';
import Resource from '@/api/resource';
const membershipResource = new Resource('membership');

export default {
  name: 'MyMembership',
  components: { ViewMembership, MembershipList },
  data() {
    return {
      membership: {},
      loading: true,
    };
  },
  created() {
    this.getMembershipData();
  },
  methods: {
    checkRole,
    async getMembershipData() {
      const { data } = await membershipResource.list({});
      if (data[0].status === 'NONE'){
        this.user_type = 'user';
        this.$confirm('Do you want to proceed with filling up the membership application form?', 'Confirm Membership Application', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
          center: true,
        })
          .then(({ value }) => {
            this.$router.push({ name: 'createMembershipPage' }, onAbort => {});
          }).catch(() => {
            this.$router.push({ name: 'Dashboard' }, onAbort => {});
          });
        this.loading = false;
      } else {
        this.loading = false;
      }
    },
  },
};
</script>
