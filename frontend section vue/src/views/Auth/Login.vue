<template>
  <div class="container py-4">
    <div class="row">
      <div class="col md-12">
   <section class=" py-5">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://img.freepik.com/premium-vector/online-registration-sign-up-concept-with-man-character_268404-98.jpg?size=626&ext=jpg&ga=GA1.1.382716077.1698238667&semt=sph"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form @submit.prevent="login">

          <div class="divider d-flex align-items-center my-4"><h4>SIGN IN HERE</h4>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Email Addreess" v-model="credential.email"/>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Password</label>
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Password" v-model="credential.password"/>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="">
                <p class="small fw-bold mt-1 pt-1 mb-0">Don't have an account? <a href="/register"
                class="link-danger">Register</a></p>
            </div>
            <button type="submit" class="btn btn-primary btn-sl"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
      </div>
    </div>
  </div>
</template>

<script>
import toastr from 'toastr';
window.toastr = require('toastr')

export default {
    name: "Login-menu",
    data() {
    return {
           credential:{
            email: 'demo@gmail.com',
            password: '12345678'
        }
    }
},
    methods: {
        login(){
            this.$store.dispatch('login', this.credential).then(res => {
              toastr.success (res.message)
              this.$router.push({
                name: "dashboard"
              })
            }).catch(error => {
        if (error.response && error.response.data && error.response.data.error) {
          for (const v of Object.entries(error.response.data.error)) {
            toastr.error(v);
          }
        } else {
            toastr.error(error.response.data.message);
        }
      });
    }
    }
}
</script>