<template>
    <div class="container py-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
               <div>
                <b><h5>Department Information</h5></b>
                  </div>
                     <div>
                       <router-link :to="{name: 'create'}" class="btn btn-outline-dark">Create Department</router-link>
                      </div>
                 </div>
            </div>
            <div class="card-body">
              <table id="departmentTable" class="table table-striped table-bordered" style="width:100%">
                <thead align="center">
                  <tr>
                    <th size="5">ID</th>
                    <th size="75">Name</th>
                    <th size="20">Actiion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="dt in departments" :key="dt.id">
                    <td align="center">{{ dt.id }}</td>
                    <td>{{ dt.department_name }}</td>
                    <td align="center">
                      <router-link :to="{ name: 'departmentEdit', params: { id: dt.id } }" class="btn btn-outline-success btn-sm mx-2">
                         <i class="fas fa-edit"></i></router-link>
                          <button @click="deleteDepartment(dt.id)" class="btn btn-outline-danger btn-sm mx-2">
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
  import toastr from 'toastr';
  import $ from 'jquery';
  import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
  import 'datatables.net-bs5/js/dataTables.bootstrap5.min.js';
  import 'datatables.net-bs5';
  
  export default {
    name: "DepartmentMenu",
    data() {
      return {
        departments: [],
      };
    },
    created() {
      this.getDepartments();
    },
    methods: {
          
      async deleteDepartment(departmentId) {
         const url = `http://127.0.0.1:8000/api/v1/department/remove/${departmentId}`;
       try {
          await axios.delete(url, {
            headers: {
                Authorization: `Bearer ${this.$store.state.token}`,
                 },
             });
          this.departments = this.departments.filter((dept) => dept.id !== departmentId);
            toastr.success('Department deleted successfully');
            } catch (error) {
             console.error(error);
             toastr.error('Error deleting department');
          }
        },


      async getDepartments() {
        const url = 'http://127.0.0.1:8000/api/v1/department';
        try {
          const response = await axios.get(url, {
            headers: {
              Authorization: `Bearer ${this.$store.state.token}`,
            },
          });
        this.departments = response.data;
        this.$nextTick(() => {
          this.initDataTable();
        });
        } catch (error) {
          console.log(error);
        }
      },
      initDataTable() {
        $('#departmentTable').DataTable({
          paging: true, 
          searching: true, 
          lengthMenu: [[10, 25, 50], [10, 25, 50]], 
          pageLength: 10, 
        });
      },
    },
  };
  </script>
  