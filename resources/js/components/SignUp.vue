<template>
 <div class="login">
    <div class="login__slider">
        <img width="400" src="https://images.pexels.com/photos/1624487/pexels-photo-1624487.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"/>
    </div>

    <div class="login__form">
        <h2>Sign Up</h2>
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
          'username',
          { rules: [{ required: true, message: 'Please input your username!' }] },
        ]"
        type="text"
        placeholder="Username"
      >
        <a-icon slot="prefix" type="lock" style="color: rgba(0,0,0,.25)" />
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
    <a-form-item>
      <a-input
        v-decorator="[
          'password_confirmation',
          { rules: [
            { required: true,
            message: 'Please confirm your password'
            },
            {
                validator: comparePassword
            }
            ] },
        ]"
        type="password"
        placeholder="password_confirmation"
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
       <router-link to="/login">Login</router-link>
    </a-form-item>
  </a-form>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
export default {
    beforeCreate() {
        this.form = this.$form.createForm(this, {name:'register-form'});
        this.loading = false;
        },
    methods: {
        submit(event) {
            this.loading = true;
            event.preventDefault();
            this.form.validateFields(async(errs, values) => {
                this.loading = false;
                if(!errs) {
                    console.log(values);
                    try {
                        const response = await Axios.post("/api/v1/user", {...values});
                        // TODO add api Design
                        console.log(response);
                    } catch (error) {
                        console.log(error);
                    }


            }
        });
        },
        comparePassword(rule, value, callback) {
        const form = this.form;
        if (value && value !== form.getFieldValue('password')) {
            callback('Password and password confirmation must match');
        } else {
            callback();
        }
    },
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
    } }
</style>
