<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
               <div>
                <b><h5>Result Information</h5></b>
                  </div>
                     <div>
                       <router-link :to="{name: 'rs.create'}" class="btn btn-outline-dark">Create Result</router-link>
                      </div>
                 </div>
            </div>
          <div class="card-body">
            <table id="resultTable" class="table table-striped table-bordered" style="width:100%">
              <thead align="center">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Result</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(rs, index) in results" :key="rs.id">
                  <td align="center">{{ index + 1 }}</td>
                  <td>{{ rs.name }}</td>
                  <td>GPA {{ rs.gpa }}</td>
                  <td>{{ formatDate(rs.date) }}</td>
                  <td align="center">
                    <router-link :to="{ name: 'resultEdit', params: { id: rs.id } }" class="btn btn-outline-success btn-sm mx-2">
                         <i class="fas fa-edit"></i></router-link>
                          <button @click="deleteResult(rs.id)" class="btn btn-outline-danger btn-sm mx-2">
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
      results: [],
    };
  },
  created() {
    this.getResults();
  },
methods: {

  formatDate(dateString) {
      const options = {day: '2-digit', month: '2-digit',year: 'numeric' };
      return new Date(dateString).toLocaleDateString(undefined, options);
    },


    async deleteResult(resultId) {
         const url = `http://127.0.0.1:8000/api/v1/result/remove/${resultId}`;
       try {
          await axios.delete(url, {
            headers: {
                Authorization: `Bearer ${this.$store.state.token}`,
                 },
             });
          this.results = this.results.filter((rs) => rs.id !== resultId);
            toastr.success('Result deleted successfully');
            } catch (error) {
             console.error(error);
             toastr.error('Error deleting result');
          }
        },


async getResults() {
  const url = 'http://127.0.0.1:8000/api/v1/result';
  try {
    const response = await axios.get(url, {
      headers: {
        Authorization: `Bearer ${this.$store.state.token}`,
      },
    });
    this.results = response.data.results;
    console.log(this.results);
    this.$nextTick(() => {
          this.initDataTable();
        });
    } catch (error) {
    console.log(error);
    }
    },

    initDataTable() {
      $('#resultTable').DataTable({
        paging: true, 
        searching: true, 
        lengthMenu: [[10, 25, 50], [10, 25, 50]], 
        pageLength: 10, 
      });
    },
  },
};
</script>
