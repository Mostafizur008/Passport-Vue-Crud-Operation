<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <b>
              <h5>Create Department</h5>
            </b>
          </div>
          <div class="card-body">
            <form @submit.prevent="department">
              <div class="mb-3">
                <label for="departmentName" class="form-label">Department Name</label>
                <input type="text" class="form-control" v-model="formData.department_name">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
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
import 'toastr/toastr.scss'; // Import the toastr CSS if not already done

export default {
  name: "DepartmentAdd",
  data() {
    return {
      formData: {
        department_name: '',
      },
    };
  },
  methods: {
    department() {
      axios.post('http://127.0.0.1:8000/api/v1/department/create', this.formData, {
        headers: {
          Authorization: `Bearer ${this.$store.state.token}`,
        }
      })
      .then(res => {
        toastr.success(res.data.message);
        this.$router.push({
          name: "department"
        });
      })
      .catch(error => {
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
};
</script>
