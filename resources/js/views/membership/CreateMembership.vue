<template>
  <div v-loading="loading" class="createPost-container">
    <sticky :class-name="'sub-navbar'">
      <el-button
        v-loading="loading"
        style="margin-left: 10px;"
        type="success"
        @click="onSubmit"
      >
        Submit Application
      </el-button>
      <el-button v-loading="loading" type="warning" @click="onSubmit">
        Draft
      </el-button>
    </sticky>
    <div class="app-container">
      <el-form ref="form" size="small" :model="form" :rules="membershipRules" label-width="120px" label-position="top">
        <el-card class="box-card">
          <div slot="header" class="clearfix">
            <span>Personal Data</span>
          </div>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Last Name" prop="last_name">
                <el-input v-model="form.last_name" placeholder="Enter Last Name" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="First Name" prop="first_name">
                <el-input v-model="form.first_name" placeholder="Enter First Name" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Middle Name" prop="middle_name">
                <el-input v-model="form.middle_name" placeholder="Enter Middle Name" />
              </el-form-item>
            </el-col>
          </el-row> <!-- name -->
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Civil Status" prop="civil_status">
                <el-select v-model="form.civil_status" filterable placeholder="Please Select Civil Status" :clearable="true">
                  <el-option label="Single" value="Single" />
                  <el-option label="Married" value="Married" />
                  <el-option label="Separated" value="Separated" />
                  <el-option label="Annulled" value="Annulled" />
                  <el-option label="Widow" value="Widow" />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Date of Birth" prop="birth_date">
                <el-date-picker v-model="form.birth_date" :picker-options="pickerOptions" type="date" default-value="2010-10-01" placeholder="Pick a date" style="width: 100%;" value-format="YYYY-mm-dd" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Place of Birth" prop="birth_place">
                <el-input v-model="form.birth_place" placeholder="Enter Birth Place" />
              </el-form-item>
            </el-col>
          </el-row> <!-- civil status birth details -->
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Email" prop="email_address">
                <el-input v-model="form.email_address" placeholder="username@domain.com" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Contact No." prop="contact_number">
                <el-input v-model="form.contact_number" placeholder="09121234567" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Contact -->
          <br>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Region" prop="region">
                <el-select v-model="form.region" filterable placeholder="Select Region" @change="getProvince">
                  <el-option
                    v-for="item in region"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Province" prop="province">
                <el-select v-model="form.province" filterable placeholder="Select Province" @change="getCity">
                  <el-option
                    v-for="item in province"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="City" prop="city">
                <el-select v-model="form.city" filterable placeholder="Select City" @change="getBarangay">
                  <el-option
                    v-for="item in city"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Barangay" prop="barangay">
                <el-select v-model="form.barangay" filterable placeholder="Select Barangay">
                  <el-option
                    v-for="item in barangay"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="House Number" prop="house_number">
                <el-input v-model="form.house_number" placeholder="Enter House/Apartment Number" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Street / Subdivision" prop="street">
                <el-input v-model="form.street" placeholder="Enter Stree/Subdivision" />
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
                <el-select v-model="form.department" placeholder="Select Department">
                  <el-option label="Philippine National Police (PNP)" value="Philippine National Police (PNP)" />
                  <el-option label="Armed Forces of the Philippines (AFP)" value="Armed Forces of the Philippines (AFP)" />
                  <el-option label="Bureau of Jail Management and Penology (BJMP)" value="Bureau of Jail Management and Penology (BJMP)" />
                  <el-option label="Philippin Coast Guard (PCG)" value="Philippin Coast Guard (PCG)" />
                  <el-option label="Bereau of Fire Protection (BFP)" value="Bereau of Fire Protection (BFP)" />
                  <el-option label="Others" value="Others" />
                </el-select>
              </el-form-item>
              <el-form-item v-if="form.department==='Others'">
                <el-input v-model="form.department_others" placeholder="Please Enter Department Name" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Service Status" prop="service_status">
                <el-select v-model="form.service_status" placeholder="Select Status">
                  <el-option label="Active (BOS)" value="Active" />
                  <el-option label="Retired (BOS)" value="Retired" />
                  <el-option label="Dependent (BOS)" value="Dependent" />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Years in the Uniformed Service" prop="service_years">
                <el-input v-model="form.service_years" placeholder="Please Enter Years in the Uniformed Service" />
              </el-form-item>
            </el-col>
            <!-- Years in Service -->
          </el-row>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Rank / Unit">
                <el-input v-model="form.rank_unit" placeholder="Please Enter Rank / Unit" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Gross Monthly Income (PHP)" prop="gross_income">
                <el-input v-model="form.gross_income" placeholder="Please Enter Monthly Gross Income (PHP)" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Rank Details -->
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Pay Jurisdiction">
                <el-input v-model="form.pay_jurisdiction" placeholder="Please Enter Pay Jurisdiction" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Payslip Account No." label-width="235px">
                <el-input v-model="form.pay_slip_account_no" placeholder="Please Enter Payslip Account No." />
              </el-form-item>
            </el-col>
          </el-row> <!-- Pay Jurisdiction -->
        </el-card>
        <br>
        <el-card class="box-card">
          <div slot="header" class="clearfix">
            <span>Capital Build Up Pledge</span>
          </div>
          <el-row :gutter="100">
            <el-col>
              I hereby apply for membership in the <b>LAKAS BAYANIHAN CREDIT COOPERATIVE</b>, and agree to faithfully obey its rules and regulations as set down in its by-laws and amendments thereof, or elsewhere and the decisions of the general membership meetings as well as those of the board of directors.           </el-col>
          </el-row>
          <br>
          <el-row :gutter="40">
            <el-col>
              I agree to pay the required membership fee of PHP {{ form.membership_fee }}. The current per one (1) share amount is PHP {{ form.share_rate }}.
            </el-col>
          </el-row>
          <br>
          <el-row :gutter="20">
            <el-col :lg="8" :md="8">
              <el-form-item label="Pledge Subscription" prop="pledge_subscription">
                <el-input v-model="form.pledge_subscription" placeholder="Pledge Subscription Amount" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="8">
              <el-form-item label="Initial Paid Up Capital" prop="initial_capital_payment">
                <el-input v-model="form.initial_capital_payment" placeholder="Initial Paid Up Capital Amount" />
              </el-form-item>
            </el-col>
          </el-row> <!-- Pledge amount and capital share -->
          <el-row :gutter="40">
            <el-col>
              <el-button type="success" plain @click="onSubmit">Submit Application</el-button>
            </el-col>
          </el-row>
        </el-card>
      </el-form>
    </div>
  </div>
</template>

<script>
import Sticky from '@/components/Sticky'; // Sticky header
import { validEmail, validAddress, validName, validPhone, validNumber, noSpecialCharacters } from '@/utils/validate';
import { csrf } from '@/api/auth';
import Resource from '@/api/resource';
const regionResource = new Resource('regions');
const provinceResource = new Resource('provinces');
const cityResource = new Resource('cities');
const barangayResource = new Resource('barangays');
const membershipResource = new Resource('membership');
const settingResource = new Resource('settings');

export default {
  name: 'CreateMembership',
  components: {
    Sticky,
  },
  data() {
    const validateBirthPlace = (rule, value, callback) => {
      if (value !== '' && !validAddress(value)) {
        callback(new Error('Please enter valid address format'));
      } else {
        callback();
      }
    };
    const validateAddress = (rule, value, callback) => {
      if (!validAddress(value)) {
        callback(new Error('Please enter valid address format'));
      } else {
        callback();
      }
    };
    const validateNoSpecialChars = (rule, value, callback) => {
      if (value !== '' && !noSpecialCharacters(value)) {
        callback(new Error('Please enter valid format (no special characters allowed)'));
      } else {
        callback();
      }
    };
    const validateNumber = (rule, value, callback) => {
      if (!validNumber(value)) {
        callback(new Error('Please enter valid number format'));
      } else {
        callback();
      }
    };
    const validatePhone = (rule, value, callback) => {
      if (!validPhone(value)) {
        callback(new Error('Please enter valid phone format'));
      } else {
        callback();
      }
    };
    const validateEmail = (rule, value, callback) => {
      if (!validEmail(value)) {
        callback(new Error('Please enter the correct email'));
      } else {
        callback();
      }
    };
    const validateName = (rule, value, callback) => {
      if (!validName(value)) {
        callback(new Error('Please enter valid alphabet format'));
      } else {
        callback();
      }
    };
    const validateMiddleName = (rule, value, callback) => {
      if (value !== '' && !validName(value)) {
        callback(new Error('Please enter valid alphabet format'));
      } else {
        callback();
      }
    };
    const validateEmpty = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('This field is required'));
      } else {
        callback();
      }
    };
    return {
      pickerOptions: {
        disabledDate: this.disabledDate,
      },
      form: {
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
      },
      membershipRules: {
        last_name: [{ required: true, trigger: 'blur', validator: validateName }],
        first_name: [{ required: true, trigger: 'blur', validator: validateName }],
        middle_name: [{ trigger: 'blur', validator: validateMiddleName }],
        civil_status: [{ required: true, trigger: 'change', validator: validateEmpty }],
        birth_date: [{ required: true, trigger: 'blur', validator: validateEmpty }],
        birth_place: [{ trigger: 'blur', validator: validateBirthPlace }],
        email_address: [{ required: true, trigger: 'blur', validator: validateEmail }],
        contact_number: [{ required: true, trigger: 'change', validator: validatePhone }],
        region: [{ required: true, trigger: 'change', validator: validateEmpty }],
        province: [{ required: true, trigger: 'change', validator: validateEmpty }],
        city: [{ required: true, trigger: 'change', validator: validateEmpty }],
        barangay: [{ required: true, trigger: 'change', validator: validateEmpty }],
        house_number: [{ required: true, trigger: 'change', validator: validateAddress }],
        street: [{ trigger: 'blur', validator: validateNoSpecialChars }],
        department: [{ required: true, trigger: 'blur', validator: validateEmpty }],
        service_status: [{ required: true, trigger: 'blur', validator: validateEmpty }],
        service_years: [{ required: true, trigger: 'blur', validator: validateNumber }],
        gross_income: [{ required: true, trigger: 'blur', validator: validateNumber }],
        pledge_subscription: [{ required: true, trigger: 'blur', validator: validateNumber }],
        initial_capital_payment: [{ required: true, trigger: 'blur', validator: validateNumber }],
      },
      activeName: 'first',
      loading: true,
      redirect: '/dashboard',
      settings: [],
      region: [],
      province: [],
      city: [],
      barangay: [],
    };
  },
  created(){
    this.checkIfMembershipExist();
  },
  methods: {
    async checkIfMembershipExist(){
      this.loading = true;
      const { data } = await membershipResource.list({});
      if (data[0].status === 'ADMIN'){
        this.$router.push({ name: 'Dashboard' }, onAbort => {});
      } else if (data[0].status === 'PENDING' || data[0].status === 'APPROVED' || data[0].status === 'REJECTED'){
        this.$alert('You already have an application. You can not create another application. Redirecting you to dashboard.', 'Membership Application Existing', {
          confirmButtonText: 'OK',
          type: 'success',
          center: true,
        }).then(() => {
          this.$router.push({ name: 'Dashboard', params: { refresh: 'true' }}, onAbort => {});
        }).catch(() => {
          this.$router.push({ name: 'Dashboard', params: { refresh: 'true' }}, onAbort => {});
        });
        this.loading = false;
      } else {
        this.form.first_name = data[0].profile.first_name;
        this.form.last_name = data[0].profile.last_name;
        this.form.email_address = data[0].profile.email;
        this.getSetting();
        this.getRegion();
        this.loading = false;
      }
    },
    disabledDate(date) {
      return new Date() < date;
    },
    async getSetting() {
      const { data } = await settingResource.list({});
      this.settings = data;
      console.log(data);
      this.form.membership_fee = data[0].membership_fee;
      this.form.share_rate = data[0].share_rate;
    },
    async getRegion() {
      const { data } = await regionResource.list({});
      this.region = data;
    },
    async getProvince() {
      this.form.province = '';
      this.form.city = '';
      this.form.barangay = '';
      this.province = [];
      this.city = [];
      this.barangay = [];
      const { data } = await provinceResource.list({ 'regCode': this.form.region });
      this.province = data;
    },
    async getCity() {
      this.form.city = '';
      this.form.barangay = '';
      this.city = [];
      this.barangay = [];
      const { data } = await cityResource.list({ 'provCode': this.form.province });
      this.city = data;
    },
    async getBarangay() {
      this.form.barangay = '';
      this.barangay = [];
      const { data } = await barangayResource.list({ 'cityCode': this.form.city });
      this.barangay = data;
    },
    onSubmit() {
      // this.$router.push({ name: 'Dashboard', params: { refresh: 'true' } }, onAbort => {});
      this.$refs.form.validate(valid => {
        if (valid) {
          this.$confirm('By clicking the submit button, you agree to the terms and condition set by the Cooperative. Do you want to proceed with the membership application?', 'Confirm Membership Application', {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning',
            center: true,
          })
            .then(({ value }) => {
              this.loading = true;
              csrf().then(() => {
                membershipResource.store(this.form)
                  .then(() => {
                    this.$alert('You application has been submitted and is for approval.', 'Application Submitted', {
                      confirmButtonText: 'OK',
                      type: 'success',
                      center: true,
                    }).then(() => {
                      this.$router.push({ name: 'Dashboard', params: { refresh: 'true' }}, onAbort => {});
                      this.loading = false;
                    }).catch(() => {
                      this.loading = false;
                    });
                  })
                  .catch(() => {
                    this.loading = false;
                  });
              });
            }).catch(() => {
              this.$message({
                type: 'info',
                message: 'Input canceled',
              });
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    onCancel() {
      this.$message({
        message: 'cancel!',
        type: 'warning',
      });
    },
  },
};
</script>

<style scoped>
.line{
  text-align: center;
}
</style>

