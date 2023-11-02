<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <b>
              <h5>Edit Student</h5>
            </b>
          </div>
          <div class="card-body">
            <form @submit.prevent="updateStudent">
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label">Student Name</label>
                    <input type="text" class="form-control" v-model="formData.name" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label">Department Name</label>
                    <select class="form-select" v-model="formData.department_id">
                      <option value="" selected disabled>Choose the department</option>
                      <option
                        v-for="department in departments"
                        :key="department.id"
                        :value="department.id"
                      >
                        {{ department.department_name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Batch Name</label>
                <input type="text" class="form-control" v-model="formData.batch_name" />
              </div>
              <div class="justify-content: center">
                <button type="submit" class="btn btn-primary btn-block mb-4">Update</button>
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
import 'toastr/toastr.scss';

export default {
  name: "StudentEdit",
  data() {
    return {
      formData: {
        name: '',
        department_id: '',
        batch_name: '',
      },
      studentId: null,
      departments: [],
    };
  },
  methods: {
    fetchData() {
      const id = this.$route.params.id;
      this.studentId = id;

      axios.get(`http://127.0.0.1:8000/api/v1/student/${id}`, {
        headers: {
          Authorization: `Bearer ${this.$store.getters.getToken}`,
        },
      })
        .then((res) => {
          console.log('API Response:', res.data);

          if (res.data.status && res.data.data) {
            this.formData = res.data.data;
          } else {
            console.error('Invalid response structure:', res.data);
          }
        })
        .catch((error) => {
          console.error('API request error:', error);
        });

      axios.get('http://127.0.0.1:8000/api/v1/department', {
        headers: {
          Authorization: `Bearer ${this.$store.getters.getToken}`,
        },
      })
        .then((res) => {
          console.log('Department API Response:', res.data);
          this.departments = res.data;
        })
        .catch((error) => {
          console.error('Department API request error:', error);
        });
    },

    updateStudent() {
      const id = this.studentId;
      axios.put(`http://127.0.0.1:8000/api/v1/student/${id}/edit`, this.formData, {
        headers: {
          Authorization: `Bearer ${this.$store.getters.getToken}`,
        },
      })
        .then((res) => {
          toastr.success(res.data.message);
          this.$router.push({
            name: 'students',
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
