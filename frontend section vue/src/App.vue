<template>
  <navbar></navbar>
  <router-view/>
  <Footer></Footer>
</template>

<script>
import Navbar from "./components/Navbar"
import Footer from "./components/Footer"
export default {
  components: { Navbar,Footer }
  }
</script>
<style>
</style>

