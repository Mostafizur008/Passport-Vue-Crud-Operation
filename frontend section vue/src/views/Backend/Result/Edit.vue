<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <b>
              <h5>Edit Result</h5>
            </b>
          </div>
          <div class="card-body">
            <form @submit.prevent="updateResult">
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label">Student Name</label>
                    <select class="form-select" v-model="formData.student_id">
                      <option value="" selected disabled>Choose the Student</option>
                      <option
                        v-for="student in students"
                        :key="student.id"
                        :value="student.id"
                      >
                        {{ student.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label">GPA</label>
                    <input type="number" class="form-control" v-model="formData.gpa" />
                  </div>
                </div>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Date</label>
                <input type="date" class="form-control" v-model="formData.date" />
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
  name: "ResultEdit",
  data() {
    return {
      formData: {
        gpa: '',
        student_id: '',
        date: '',
      },
      resultId: null,
      students: [],
    };
  },
  methods: {
    fetchData() {
      const id = this.$route.params.id;
      this.resultId = id;

      axios.get(`http://127.0.0.1:8000/api/v1/result/${id}`, {
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

      axios.get('http://127.0.0.1:8000/api/v1/student', {
        headers: {
          Authorization: `Bearer ${this.$store.getters.getToken}`,
        },
      })
        .then((res) => {
          console.log('Student API Response:', res.data);
          this.students = res.data.students;
        })
        .catch((error) => {
          console.error('Student API request error:', error);
        });
    },

    updateStudent() {
      const id = this.studentId;
      axios.put(`http://127.0.0.1:8000/api/v1/result/${id}/edit`, this.formData, {
        headers: {
          Authorization: `Bearer ${this.$store.getters.getToken}`,
        },
      })
        .then((res) => {
          toastr.success(res.data.message);
          this.$router.push({
            name: 'results',
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
