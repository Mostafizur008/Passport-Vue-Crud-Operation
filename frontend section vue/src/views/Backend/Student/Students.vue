<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
               <div>
                <b><h5>Students Information</h5></b>
                  </div>
                     <div>
                       <router-link :to="{name: 'st.create'}" class="btn btn-outline-dark">Create Student</router-link>
                      </div>
                 </div>
            </div>
          <div class="card-body">
            <table id="studentTable" class="table table-striped table-bordered" style="width:100%">
              <thead align="center">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Batch</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="st in students" :key="st.id">
                  <td align="center">{{ st.id }}</td>
                  <td>{{ st.name }}</td>
                  <td>{{ st.department_name }}</td>
                  <td>{{ st.batch_name }}</td>
                  <td align="center">
                    <router-link :to="{ name: 'studentEdit', params: { id: st.id } }" class="btn btn-outline-success btn-sm mx-2">
                         <i class="fas fa-edit"></i></router-link>
                          <button @click="deleteStudent(st.id)" class="btn btn-outline-danger btn-sm mx-2">
                                      <i class="fas fa-trash-alt"></i>
                         </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import $ from 'jquery';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-bs5/js/dataTables.bootstrap5.min.js';
import 'datatables.net-bs5';
import toastr from 'toastr';

export default {
  name: "StudentMenu",
  data() {
    return {
      students: [],
    };
  },
  created() {
    this.getStudents();
  },
  methods: {

    async deleteStudent(studentId) {
         const url = `http://127.0.0.1:8000/api/v1/student/remove/${studentId}`;
       try {
          await axios.delete(url, {
            headers: {
                Authorization: `Bearer ${this.$store.state.token}`,
                 },
             });
          this.students = this.students.filter((st) => st.id !== studentId);
            toastr.success('Student deleted successfully');
            } catch (error) {
             console.error(error);
             toastr.error('Error deleting student');
          }
        },

    async getStudents() {
      const url = 'http://127.0.0.1:8000/api/v1/student';
      try {
        const response = await axios.get(url, {
          headers: {
            Authorization: `Bearer ${this.$store.state.token}`,
          },
        });
        this.students = response.data.students;
        console.log(this.students);
        this.$nextTick(() => {
          this.initDataTable();
        });
      } catch (error) {
        console.log(error);
      }
    },
    initDataTable() {
      $('#studentTable').DataTable({
        paging: true,
        searching: true,
        lengthMenu: [[10, 25, 50], [10, 25, 50]],
        pageLength: 10,
      });
    },
  },
};
</script>
