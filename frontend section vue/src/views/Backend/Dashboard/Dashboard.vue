<template>
  <section class="vh-100" style="background-color: #ffffff;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-md-9 col-lg-7 col-xl-5">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-4">
              <div class="d-flex text-black">
                <div class="flex-shrink-0">
                  <img
                    src="http://localhost:8080/img/logo.1696290b.png"
                    alt="Generic placeholder image"
                    class="img-fluid"
                    style="width: 130px; border-radius: 10px;"
                  />
                </div>
                <div class="flex-grow-1 ms-3">
                  <h5 class="mb-1"><b>Admin</b></h5>
                  <p class="mb-2 pb-1" style="color: #2b2a2a;">demo@gmail.com</p>
                  <br />
                  <div class="d-flex pt-1">
                    <button type="button" class="btn btn me-1 flex-grow-1"></button>
                    <a type="button" class="btn btn-outline-primary flex-grow" href="/login" v-if="loggedIn">Logout</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "DashboardMenu",
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    },
    user() {
      return this.$store.getters.user;
    },
  },
};
</script>
