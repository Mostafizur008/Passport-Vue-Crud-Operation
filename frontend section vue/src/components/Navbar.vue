<template>
<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2" href="/">
      <img
        src="../assets/logo.png"
        height="53"
        alt="MDB Logo"
        loading="lazy"
        style="margin-top: -1px;"
      />
    </a>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'student'}" v-if="!loggedIn">Student</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'result'}" v-if="!loggedIn">Result</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'search'}" v-if="!loggedIn">Search</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'dashboard' }" v-if="loggedIn">
           <b style="color: red;">|</b> Dashboard
         </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'department'}" v-if="loggedIn">Department</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'students'}" v-if="loggedIn">Student</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'results'}" v-if="loggedIn">Result</router-link>
        </li>
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center">
        <router-link class="btn btn-link px-3 me-3" :to="{name: 'login'}" v-if="!loggedIn">
          <h6><b>Login</b></h6>
        </router-link>
        <a type="button" class="btn btn-primary btn-sl" href="/register" v-if="!loggedIn">
          Sign up
        </a>
        <a type="button" class="btn btn-outline-primary btn-sl" href="/login" v-if="loggedIn">
          Logout
        </a>
      </div>

      <div>
  </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
</template>

<style scoped>

</style>

<script>
export default {
    name: "Nav-bar",
    computed: {
      loggedIn(){
        return this.$store.getters.loggedIn
      }
    }
    }
</script>

