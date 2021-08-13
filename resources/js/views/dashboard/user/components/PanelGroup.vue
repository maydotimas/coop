<template>
  <el-row v-if="loaded" :gutter="40" class="panel-group">
    <el-col v-if="membership.status === 'NONE'" :xs="15" :sm="15" :md="10" :lg="8" class="card-panel-col">
      <div class="card-panel">
        <div class="card-panel-icon-wrapper icon-people">
          <svg-icon icon-class="peoples" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">
            Membership Application
          </div>
          <el-button @click="apply_membership">Apply Here</el-button>
        </div>
      </div>
    </el-col>
    <el-col v-if="membership.status === 'PENDING'" :xs="15" :sm="15" :md="10" :lg="8" class="card-panel-col">
      <div class="card-panel">
        <div class="card-panel-icon-wrapper icon-people">
          <svg-icon icon-class="peoples" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">
            Membership Application
          </div>
          <el-button @click="view_membership">View Application</el-button>
        </div>
      </div>
    </el-col>
    <el-row v-if="membership.status === 'APPROVED'" :gutter="40" class="panel-group">
      <el-col :xs="12" :sm="12" :md="8" :lg="6" class="card-panel-col">
        <div class="card-panel">
          <div class="card-panel-icon-wrapper icon-people">
            <svg-icon icon-class="peoples" class-name="card-panel-icon" />
          </div>
          <div class="card-panel-description">
            <div class="card-panel-text">
              My Profile
            </div>
            <el-button class="pull-right" @click="apply_membership">Manage</el-button>
          </div>
        </div>
      </el-col>
      <el-col :xs="12" :sm="12" :md="8" :lg="6" class="card-panel-col">
        <div class="card-panel">
          <div class="card-panel-icon-wrapper icon-message">
            <svg-icon icon-class="message" class-name="card-panel-icon" />
          </div>
          <div class="card-panel-description">
            <div class="card-panel-text">
              My Loans
            </div>
            <el-button class="pull-right" @click="apply_membership">Manage</el-button>
          </div>
        </div>
      </el-col>
      <el-col :xs="12" :sm="12" :md="8" :lg="6" class="card-panel-col">
        <div class="card-panel" @click="handleSetLineChartData('purchases')">
          <div class="card-panel-icon-wrapper icon-money">
            <svg-icon icon-class="money" class-name="card-panel-icon" />
          </div>
          <div class="card-panel-description">
            <div class="card-panel-text">
              My Capital Share
            </div>
            <el-button class="pull-right" @click="apply_membership">Manage</el-button>
          </div>
        </div>
      </el-col>
    </el-row>
  </el-row>
</template>

<script>
// import CountTo from 'vue-count-to';

export default {
  // components: {
  //   CountTo,
  // },
  props: {
    membership: {
      type: Object,
      default: function() {
        return {
          'status': 'NONE',
        };
      },
    },
    loaded: {
      type: Boolean,
      default: function() {
        return false;
      },
    },
  },
  created(){
    console.log(this.membership);
  },
  methods: {
    apply_membership(){
      this.$router.push({ path: '/membership/create' }, onAbort => {});
    },
    view_membership(){
      this.$router.push({ path: '/membership/details' }, onAbort => {});
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.panel-group {
  margin-top: 18px;
  .card-panel-col{
    margin-bottom: 32px;
  }
  .card-panel {
    height: 108px;
    cursor: pointer;
    font-size: 12px;
    position: relative;
    overflow: hidden;
    color: #666;
    background: #fff;
    box-shadow: 4px 4px 40px rgba(0, 0, 0, .05);
    border-color: rgba(0, 0, 0, .05);
    &:hover {
      .card-panel-icon-wrapper {
        color: #fff;
      }
      .icon-people {
         background: #40c9c6;
      }
      .icon-message {
        background: #36a3f7;
      }
      .icon-money {
        background: #f4516c;
      }
      .icon-shopping {
        background: #34bfa3
      }
    }
    .icon-people {
      color: #40c9c6;
    }
    .icon-message {
      color: #36a3f7;
    }
    .icon-money {
      color: #f4516c;
    }
    .icon-shopping {
      color: #34bfa3
    }
    .card-panel-icon-wrapper {
      float: left;
      margin: 14px 0 0 14px;
      padding: 16px;
      transition: all 0.38s ease-out;
      border-radius: 6px;
    }
    .card-panel-icon {
      float: left;
      font-size: 48px;
    }
    .card-panel-description {
      float: right;
      font-weight: bold;
      margin: 26px;
      margin-left: 0px;
      .card-panel-text {
        line-height: 18px;
        color: rgba(0, 0, 0, 0.45);
        font-size: 16px;
        margin-bottom: 12px;
      }
      .card-panel-num {
        font-size: 20px;
      }
    }
  }
}
</style>
