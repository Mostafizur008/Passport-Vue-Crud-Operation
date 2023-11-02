<template>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <b>
                <h5>Create Result</h5>
              </b>
            </div>
            <div class="card-body">
              <form @submit.prevent="result">
                <div class="row mb-4">
                    <div class="col">
                    <div class="form-outline">
                      <label class="js-example-basic-multiple">Student Name</label>
                      <select class="form-control selectpicker" data-live-search="true" v-model="formData.student_id">
                        <option value="" disabled>Choose the student</option>
                        <option
                          v-for="student in students"
                          :key="student.id"
                          :value="student.id"
                          class="custom-option">
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
                  <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <style>
  .custom-option {
    color: black !important;
    background-color: white !important;
  }
  </style>
  
  
  <script>
  import axios from 'axios';
  import toastr from 'toastr';
  import 'toastr/toastr.scss';
  
  export default {
    name: "ResultAdd",
    data() {
      return {
        formData: {
          gpa: '',
          student_id: '',
          date: ''
        },
        students: [],
      };
    },
    created() {
      this.getStudents();
    },
    methods: {

    getStudents() {
     axios.get('http://127.0.0.1:8000/api/v1/student', {
        headers: {
      Authorization: `Bearer ${this.$store.state.token}`,
    }
     })
    .then(res => {
      this.students = res.data.students;
        })
       .catch(error => {
         console.error(error);
        });
       },
      result() {
        axios.post('http://127.0.0.1:8000/api/v1/result/create', this.formData, {
          headers: {
            Authorization: `Bearer ${this.$store.state.token}`,
          }
        })
          .then(res => {
            toastr.success(res.data.message);
            this.$router.push({
              name: "results"
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
  
  <style>
   .custom-option {
  color: black !important;
  background-color: white !important;
}
</style>