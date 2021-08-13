<template>
  <div class="createPost-container">
    <sticky :class-name="'sub-navbar'">
      <el-button v-if="for_approval === true && form.status === 'PENDING'" v-loading="loading" type="success" @click="approve">
        Approve
      </el-button>
      <el-button v-if="for_approval === true && form.status === 'PENDING'" v-loading="loading" type="danger" @click="reject">
        Reject
      </el-button>
      <el-button v-loading="loading" type="warning" @click="onBack">
        Back
      </el-button>
    </sticky>
    <div class="app-container">
      <el-form ref="form" v-loading="loading" size="small" :model="form" label-width="120px" label-position="top">
        <el-card v-if="form.status !== 'PENDING'" class="box-card">
          <div slot="header" class="clearfix">
            <span>Application Details</span>
          </div>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Application Status" prop="pledge_subscription">
                <el-input v-model="form.status" placeholder="Pledge Subscription Amount" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Reviewer" prop="initial_capital_payment">
                <el-input :value="form.approver | nameFilter" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Review Date" prop="initial_capital_payment">
                <el-input v-model="form.review_date" :readonly="true" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Pledge amount and capital share -->
        </el-card>
        <br>
        <el-card class="box-card">
          <div slot="header" class="clearfix">
            <span>Personal Data</span>
          </div>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Last Name" prop="last_name">
                <el-input v-model="form.last_name" placeholder="Enter Last Name" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="First Name" prop="first_name">
                <el-input v-model="form.first_name" placeholder="Enter First Name" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Middle Name" prop="middle_name">
                <el-input v-model="form.middle_name" placeholder="Enter Middle Name" :readonly="true" />
              </el-form-item>
            </el-col>
          </el-row> <!-- name -->
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Civil Status" prop="civil_status">
                <el-input v-model="form.civil_status" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Date of Birth" prop="birth_date">
                <el-date-picker v-model="form.birth_date" type="date" default-value="2010-10-01" placeholder="Pick a date" style="width: 100%;" value-format="YYYY-mm-dd" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Place of Birth" prop="birth_place">
                <el-input v-model="form.birth_place" placeholder="Enter Birth Place" :readonly="true" />
              </el-form-item>
            </el-col>
          </el-row> <!-- civil status birth details -->
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Email" prop="email_address">
                <el-input v-model="form.email_address" placeholder="username@domain.com" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Contact No." prop="contact_number">
                <el-input v-model="form.contact_number" placeholder="09121234567" :readonly="true" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Contact -->
          <br>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Region" prop="region">
                <el-input v-model="form.regDesc" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Province" prop="province">
                <el-input v-model="form.provDesc" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="City" prop="city">
                <el-input v-model="form.cityDesc" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Barangay" prop="barangay">
                <el-input v-model="form.brgyDesc" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="House Number" prop="house_number">
                <el-input v-model="form.house_number" placeholder="Enter House/Apartment Number" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Street / Subdivision" prop="street">
                <el-input v-model="form.street" placeholder="Enter Stree/Subdivision" :readonly="true" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Address -->
        </el-card>
        <br>
        <el-card class="box-card">
          <div slot="header" class="clearfix">
            <span>Work Data</span>
          </div>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Department" prop="department">
                <el-input v-model="form.department" :readonly="true" />
              </el-form-item>
              <el-form-item v-if="form.department==='Others'">
                <el-input v-model="form.department_others" placeholder="Please Enter Department Name" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Service Status" prop="service_status">
                <el-input v-model="form.service_status" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Years in the Uniformed Service" prop="service_years">
                <el-input v-model="form.service_years" placeholder="Please Enter Years in the Uniformed Service" :readonly="true" />
              </el-form-item>
            </el-col>
            <!-- Years in Service -->
          </el-row>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Rank / Unit">
                <el-input v-model="form.rank_unit" placeholder="Please Enter Rank / Unit" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Gross Monthly Income (PHP)" prop="gross_income">
                <el-input v-model="form.gross_income" placeholder="Please Enter Monthly Gross Income (PHP)" :readonly="true" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Rank Details -->
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Pay Jurisdiction">
                <el-input v-model="form.pay_jurisdiction" placeholder="Please Enter Pay Jurisdiction" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Payslip Account No." label-width="235px">
                <el-input v-model="form.pay_slip_account_no" placeholder="Please Enter Payslip Account No." :readonly="true" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Pay Jurisdiction -->
        </el-card>
        <br>
        <el-card class="box-card">
          <div slot="header" class="clearfix">
            <span>Capital Build Up Pledge</span>
          </div>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Pledge Subscription" prop="pledge_subscription">
                <el-input v-model="form.pledge_subscription" placeholder="Pledge Subscription Amount" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Initial Paid Up Capital" prop="initial_capital_payment">
                <el-input v-model="form.initial_capital_payment" placeholder="Initial Paid Up Capital Amount" :readonly="true" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Application Submission Date" prop="initial_capital_payment">
                <el-input v-model="form.created_at" :readonly="true" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Pledge amount and capital share -->
        </el-card>
      </el-form>
    </div>
  </div>
</template>

<script>
import Sticky from '@/components/Sticky'; // Sticky header
// import { validEmail, validAddress, validName, validPhone, validNumber, noSpecialCharacters } from '@/utils/validate';
// import { csrf } from '@/api/auth';
import Resource from '@/api/resource';
const membershipResource = new Resource('membership');
const settingResource = new Resource('settings');

export default {
  name: 'ViewMembership',
  components: {
    Sticky,
  },
  filters: {
    nameFilter(approver) {
      return approver.first_name + ' ' + approver.last_name;
    },
  },
  data() {
    return {
      listQuery: {
        id: '',
      },
      form: {
        id: '',
        update_status: '',
        last_name: '',
        first_name: '',
        middle_name: '',
        civil_status: '',
        birth_date: '',
        birth_place: '',
        house_number: '',
        street: '',
        subdivision: '',
        barangay: '',
        city: '',
        province: '',
        region: '',
        zip_code: '',
        email_address: '',
        contact_number: '',
        department: '',
        department_others: '',
        service_years: '',
        service_status: '',
        rank_unit: '',
        gross_income: '',
        pay_jurisdiction: '',
        pay_slip_account_no: '',
        membership_fee: '',
        share_rate: '',
        pledge_subscription: '',
        initial_capital_payment: '',
        regDesc: '',
        provDesc: '',
        cityDesc: '',
        brgyDesc: '',
        approver: [],
        profile: [],
        status: '',
        reviewer: '',
        review_date: '',
      },
      activeName: 'first',
      loading: true,
      for_approval: false,
      redirect: '/dashboard',
      settings: [],
    };
  },
  created(){
    this.check_if_review();
    this.getSetting();
  },
  methods: {
    check_if_review(){
      const id = this.$route.params && this.$route.params.id;
      if (id !== '' && id !== undefined){
        this.listQuery.id = id;
        this.for_approval = true;
      }
      this.getMembershipDetails();
    },
    disabledDate(date) {
      return new Date() < date;
    },
    async getMembershipDetails() {
      const { data } = await membershipResource.list(this.listQuery);
      if (data[0].memberships) {
        this.form = data[0].memberships[0].profile;
        this.form.approver = data[0].memberships[0].approver;
        this.form.status = data[0].memberships[0].status;
        this.form.review_date = data[0].memberships[0].approval_date;
      } else {
        this.form = data[0].profile;
        this.form.approver = data[0].approver;
        this.form.status = data[0].status;
        this.form.review_date = data[0].approval_date;
        this.form.id = data[0].id;
      }
      this.loading = false;
      this.loaded = true;
    },
    async getSetting() {
      const { data } = await settingResource.list({});
      this.settings = data;
      this.form.membership_fee = data[0].membership_fee;
      this.form.share_rate = data[0].share_rate;
    },
    onBack() {
      this.$router.go(-1);
    },
    approve(){
      this.$confirm('Do you want to approve this application?', 'Approve Application Confirmation', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
        center: true,
        dangerouslyUseHTMLString: true,
      }).then(({ value }) => {
        this.form.update_status = 'APPROVED';
        membershipResource
          .update(this.form.id, this.form)
          .then(response => {
            this.loading = false;
            this.$alert('Membership has been approved.', 'Approved membership', {
              confirmButtonText: 'OK',
              type: 'success',
              center: true,
            }).then(() => {
              this.$router.push({ path: '/membership/' });
            });
          })
          .catch(error => {
            console.log(error);
            this.loading = false;
          });
      }).catch(() => {
        this.$message({
          message: 'Approve is cancelled',
          type: 'warning',
          duration: 5 * 1000,
        });
      });
    },
    reject(){
      this.$confirm('Do you want to reject this application?', 'Reject Application Confirmation', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
        center: true,
        dangerouslyUseHTMLString: true,
      }).then(({ value }) => {
        this.form.update_status = 'REJECTED';
        membershipResource
          .update(this.form.id, this.form)
          .then(response => {
            this.loading = false;
            this.$alert('Membership has been rejected.', 'Rejected membership', {
              confirmButtonText: 'OK',
              type: 'success',
              center: true,
            }).then(() => {
              this.$router.push({ path: '/membership/' });
            });
          })
          .catch(error => {
            console.log(error);
            this.loading = false;
          });
      }).catch(() => {
        this.$message({
          message: 'Rejection is cancelled',
          type: 'warning',
          duration: 5 * 1000,
        });
      });
    },
  },
};
</script>

<style scoped>
.line{
  text-align: center;
}
.el-input .is-disabled .el-input__inner {
  background-color:white !important;
  color:black !important;
}
</style>

