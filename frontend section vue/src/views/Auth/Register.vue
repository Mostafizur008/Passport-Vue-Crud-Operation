<template>
    <div class="container py-4">
    <div class="row">
      <div class="col md-12">
      <section class=" py-5">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://img.freepik.com/free-vector/sign-up-concept-illustration_114360-7965.jpg?w=740&t=st=1698239247~exp=1698239847~hmac=2b1b1c6a4d2e614fea297146886c2441e97927460594436cad177e5d7dfa6116"
              class="img-fluid" alt="Sample image">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form @submit.prevent="register">
    
              <div class="divider d-flex align-items-center my-4"><h4>SIGN UP HERE</h4>
              </div>
    
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="name">Name</label>
                <input type="name" id="name" class="form-control form-control-lg"
                  placeholder="Full Name" v-model="formData.name"/>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="email">Email address</label>
                <input type="email" id="email" class="form-control form-control-lg"
                  placeholder="Email Address" v-model="formData.email"/>
              </div>
    
              <!-- Password input -->
              <div class="form-outline mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" class="form-control form-control-lg"
                  placeholder="Password" v-model="formData.password"/>
              </div>
    
              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="">
                    <p class="small fw-bold mt-1 pt-1 mb-0">Have already account? <a href="/login"
                    class="link-danger">Login</a></p>
                </div>
                <button type="submit" class="btn btn-primary btn-sl"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
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
        name: "Register-menu",
        data() {
    return {
           formData:  
            this.initFrom()
    }
},
    methods: {
        register(){
            this.$store.dispatch('register', this.formData).then(res => {
              toastr.success(res.message)
              this.$router.push({
                name: "login"
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
        },

        initFrom(){
          return {
            name: '',
            email: '',
            password: '',
        }
          
        }
    }
    }
    </script>