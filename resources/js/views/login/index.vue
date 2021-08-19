<template>
  <div class="login">
    <div class="login-container">
      <div class="login-image">
        <el-carousel class="carousel" height="100%">
          <el-carousel-item>
            <div class="item">
              <img class="item__image" src="/images/1.jpeg" alt="">
            </div>
          </el-carousel-item>
          <el-carousel-item>
            <div class="item">
              <img class="item__image" src="/images/2.jpeg" alt="">
            </div>
          </el-carousel-item>
          <el-carousel-item>
            <div class="item">
              <img class="item__image" src="/images/3.jpg" alt="">
            </div>
          </el-carousel-item>
          <el-carousel-item>
            <div class="item">
              <img class="item__image" src="/images/4.jpg" alt="">
            </div>
          </el-carousel-item>
        </el-carousel>
      </div>
      <div class="login-content">
        <img
          class="logo"
          alt="Laravue"
          :src="logo"
        >
        <el-form ref="loginForm" :model="loginForm" :rules="loginRules" class="login-form" label-position="left">
          <div class="title-wrap">

            <h3 class="title">
              Login Your Account
            </h3>
          </div>
          <el-form-item prop="email">
            <span class="svg-container">
              <svg-icon icon-class="email" />
            </span>
            <el-input v-model="loginForm.email" name="email" type="text" placeholder="Email Address" />
          </el-form-item>
          <el-form-item prop="password">
            <span class="svg-container">
              <svg-icon icon-class="password" />
            </span>
            <el-input
              v-model="loginForm.password"
              name="password"
              placeholder="Password"
              :type="pwdType"
              @keyup.enter.native="handleLogin"
            />
            <span class="show-pwd" @click="showPwd">
              <svg-icon icon-class="eye" />
            </span>
          </el-form-item>
          <el-form-item>
            <el-button :loading="loading" type="primary" style="width:100%;" @click.native.prevent="handleLogin">
              {{ $t('login.logIn') }}
            </el-button>
          </el-form-item>
          <div class="tips">
            <a style="margin-right:20px;" @click="showRegForm">Register</a>
          </div>
        </el-form>
      </div>
    </div>
  </div>
</template>

<script>
import { validEmail } from '@/utils/validate';
import { csrf } from '@/api/auth';

const logo = require('@/assets/login/logo.png').default;

export default {
  name: 'Login',
  data() {
    const validateEmail = (rule, value, callback) => {
      if (value !== '' && !validEmail(value)) {
        callback(new Error('Please enter the correct email'));
      } else {
        callback();
      }
    };
    const validatePass = (rule, value, callback) => {
      if (value !== '' && value.length < 4) {
        callback(new Error('Password cannot be less than 4 digits'));
      } else {
        callback();
      }
    };
    return {
      loginForm: {
        email: '',
        password: '',
      },
      loginRules: {
        email: [{ required: true, trigger: 'blur', validator: validateEmail }],
        password: [{ required: true, trigger: 'blur', validator: validatePass }],
      },
      loading: false,
      pwdType: 'password',
      redirect: '/dashboard',
      otherQuery: {},
      logo: logo,
    };
  },
  watch: {
    $route: {
      handler: function(route) {
        const query = route.query;
        if (query && (query.redirect !== '/verify' && query.redirect !== '/register')) {
          this.redirect = query.redirect;
          this.otherQuery = this.getOtherQuery(query);
        } else {
          this.redirect = '/dashboard';
          this.otherQuery = this.getOtherQuery(query);
        }
      },
      immediate: true,
    },
  },
  methods: {
    showRegForm(){
      this.$router.push({ path: '/register' }, onAbort => {});
    },
    showPwd() {
      if (this.pwdType === 'password') {
        this.pwdType = '';
      } else {
        this.pwdType = 'password';
      }
    },
    handleLogin() {
      this.$refs.loginForm.validate(valid => {
        if (valid) {
          this.loading = true;
          csrf().then(() => {
            this.$store.dispatch('user/login', this.loginForm)
              .then(() => {
                this.$router.push({ path: this.redirect || '/', query: this.otherQuery }, onAbort => {});
                this.loading = false;
              })
              .catch(() => {
                this.loading = false;
              });
          });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    getOtherQuery(query) {
      return Object.keys(query).reduce((acc, cur) => {
        if (cur !== 'redirect') {
          acc[cur] = query[cur];
        }
        return acc;
      }, {});
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss">
$bg:#2d3a4b;
$light_gray:#eee;
/* reset element-ui css */
.login-container {
  .el-input {
    display: inline-block;
    height: 47px;
    width: 85%;
    input {
      background: transparent;
      border: 0px;
      -webkit-appearance: none;
      border-radius: 0px;
      padding: 12px 5px 12px 15px;
      color: $light_gray;
      height: 47px;
      &:-webkit-autofill {
        -webkit-box-shadow: 0 0 0px 1000px $bg inset !important;
        -webkit-text-colorfill-color: rgb(8, 7, 7) !important;
      }
    }
  }
  .el-form-item {
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    color: #454545;
  }
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover,
textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus {
  -webkit-text-fill-color: white;
  -webkit-box-shadow: 0 0 0px 1000px #000 inset;
  transition: background-color 5000s ease-in-out 0s;
}

</style>

<style rel="stylesheet/scss" lang="scss" scoped>
$bg:#2d3a4b;
$dark_gray:#889aa4;
$light_gray:rgb(7, 6, 6);
$bgColor: #054b5d;
$brown: #B27C66;
$textColor:#eee;

.carousel {
  width: 100%;
  overflow:hidden;
}

.item__image{
  height: 20%;
  margin-left: -50%;
}

.logo {
  display: block;
  height: auto;
  width: 30%;
  margin-bottom: 20px;
  background-color:whitesmoke;
  margin: 15% auto;
  margin-bottom: 2%;
  border-radius: 50%;
}

.login {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background-color: $bgColor;
  transition: background-color .3s ease-in-out;
  overflow: auto;
  height:100%;

  .login-container {
    background: $bg;
    width: 1120px;
    min-height: 590px;
    display: grid;
    grid-template-columns: auto 480px;
    transition: all .3s ease-in-out;
    transform: scale(1);

    .login-image {
      display: flex;
      flex-direction: row;
      justify-content: flex-end;
      overflow: hidden;
      background-color: #303c4b;
      // background-image: url('../../assets/login/3.png');
      background-position: 50%;
      background-size: cover;
      opacity: 1;
      transition: opacity .3s ease-in-out,padding .2s ease-in-out;

      .photo-credit {
        justify-content: flex-end;
        align-self: flex-end;
        background-color: rgba(255,255,255,0.8);
        margin: 10px;
        padding: 5px 8px;

        h4, span { margin: 0; }
      }
    }

    .login-form {
      min-width: 320px;
      padding: 10% 60px;
      position: relative;
      opacity: 1;
      transition: opacity .3s ease-in-out,padding .2s ease-in-out;
    }

    .tips {
      font-size: 14px;
      color: #fff;
      margin-bottom: 10px;
      span {
        &:first-of-type {
          margin-right: 16px;
        }
      }
    }
    .svg-container {
      padding: 6px 5px 6px 15px;
      color: $dark_gray;
      vertical-align: middle;
      width: 30px;
      display: inline-block;
    }
    .title-wrap {
      display: block;
      margin-bottom: 15px;

      .title {
        font-size: 24px;
        color: $textColor;
        margin: 0px auto 10px auto;
        text-align: center;
        font-weight: bold;
      }
      .sub-heading {
        font-size: 14px;
        color: $textColor;
        padding-bottom: 15px;
      }
    }

    .show-pwd {
      position: absolute;
      right: 10px;
      top: 7px;
      font-size: 16px;
      color: $dark_gray;
      cursor: pointer;
      user-select: none;
    }
    .set-language {
      color: $textColor;
      position: absolute;
      top: 40px;
      right: 35px;
    }
  }
}

</style>
