<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <b>
              <h5>Edit Department</h5>
            </b>
          </div>
          <div class="card-body">
            <form @submit.prevent="updateDepartment">
              <div class="mb-3">
                <label for="departmentName" class="form-label">Department Name</label>
                <input type="text" class="form-control" v-model="formData.department_name">
              </div>
              <div class="d-flex justify-content-between align-items-right">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import toastr from 'toastr';

export default {
  name: 'DepartmentEdit',
  data() {
    return {
      formData: {
        department_name: '',
      },
      departmentId: null,
    };
  },
  methods: {

fetchData() {
  const id = this.$route.params.id;
  this.departmentId = id;

  axios
    .get(`http://127.0.0.1:8000/api/v1/department/${id}`, {
      headers: {
        Authorization: `Bearer ${this.$store.getters.getToken}`,
      },
    })
    .then((res) => {
      console.log('API Response:', res.data);

      if (res.data.status && res.data.data && res.data.data.department_name) {
        this.formData.department_name = res.data.data.department_name;
      } else {
        console.error('Invalid response structure:', res.data);
      }
    })
    .catch((error) => {
      console.error('API request error:', error);
    });
  },

    updateDepartment() {
      const id = this.departmentId;
      axios
        .put(`http://127.0.0.1:8000/api/v1/department/${id}/edit`, this.formData, {
          headers: {
            Authorization: `Bearer ${this.$store.getters.getToken}`,
          },
        })
        .then((res) => {
          toastr.success(res.data.message);
          this.$router.push({
            name: 'department',
          });
        })
        .catch((error) => {
          if (error.response && error.response.data && error.response.data.error) {
            for (const [key, value] of Object.entries(error.response.data.error)) {
              toastr.error(`${key}: ${value}`);
            }
          } else {
            toastr.error(error.response.data.message);
          }
        });
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>
