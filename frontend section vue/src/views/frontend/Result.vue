<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <b>
              <h5>Result Information</h5>
            </b>
          </div>
          <div class="card-body">
            <table id="resultTable" class="table table-striped table-bordered" style="width:100%">
              <thead align="center">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th align="center">Result</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, index) in results" :key="data.id">
                  <td align="center">{{ index + 1 }}</td>
                  <td>{{ data.name }}</td>
                  <td>{{ data.department_name }}</td>
                  <td align="center">GPA {{ data.gpa }}</td>
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
import 'datatables.net-bs5'; 
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'; 

export default {
  name: "ResultMenu",
  data() {
    return {
      results: [],
    };
  },
  created() {
    this.getResults();
  },
  methods: {
    async getResults() {
      const url = 'http://127.0.0.1:8000/api/v1/results';
      try {
        const response = await axios.get(url);
        this.results = response.data.results;
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