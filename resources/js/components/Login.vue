<template>
<div class="login">
    <div class="login__slider">
        <img width="400" src="https://images.pexels.com/photos/1624487/pexels-photo-1624487.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"/>
    </div>

    <div class="login__form">
        <h2>Login</h2>
         <a-form
            id="components-form-demo-normal-login"
            class="login-form"
            @submit="submit"
            :form="form"
        >
        <a-form-item
        >
      <a-input
        v-decorator="[
          'email',
          { rules: [{ required: true, message: 'Please input a valid email!', type: 'email' }] },
        ]"
        placeholder="email"
      >
        <a-icon slot="prefix" type="user" style="color: rgba(0,0,0,.25)" />
      </a-input>
    </a-form-item>
    <a-form-item>
      <a-input
        v-decorator="[
          'password',
          { rules: [{ required: true, message: 'Please input your Password!' }] },
        ]"
        type="password"
        placeholder="Password"
      >
        <a-icon slot="prefix" type="lock" style="color: rgba(0,0,0,.25)" />
      </a-input>
    </a-form-item>
     <a-button :loading="loading" size="large" shape="round" type="primary" html-type="submit" class="login-form-button">
        Lets Go
      </a-button>

    <a-form-item class="call-to-action">
      <a class="login-form-forgot" href="">
        Forgot password
      </a>
      Or
      <a href="">
        Register now!
      </a>
    </a-form-item>
  </a-form>
    </div>

  </div>
</template>

<script>
    import Axios from "axios";
    import {LOGIN_USER} from "../store/action-types";
    import {SET_USER_SUCCESS, SET_USER_START, SET_USER_FAILURE} from "../store/mutations-type";
    export default {
        beforeCreate() {
             this.form = this.$form.createForm(this, { name: 'normal_login' });
             this.loading = false;
             this.error = '';
        },
        methods: {
            submit(event) {
                this.loading = true;
                event.preventDefault();
                this.form.validateFields(async(err, values) => {
                    this.loading = false;
                    if(!err) {
                        try{
                            this.$store.commit(SET_USER_START);
                            const response = await Axios.post('/api/v1/login', {...values});
                            this.$message.success(response.data.message);
                            localStorage.setItem("token", response.data.token);
                            this.form.resetFields();
                            this.$store.commit(SET_USER_SUCCESS, {...response.data.data});
                            this.$router.push('/');
                            return;
                        }catch(error) {
                            this.error = "error";
                            const e = (error.response && error.response.data.message) ? error.response.data.message : "Login Failed";
                            this.$message.error(e);
                            this.$$store.commit(SET_USER_FAILURE, e);
                        }
                    }
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
.login {
    display: flex;
    padding: 3rem;
    align-items: center;
    justify-content: center;
    .login-form-button {
        width: 20rem;
    }

    &__form {
        padding: 5rem;
        width: 30rem;
        margin-left: 3rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
}
</style>
