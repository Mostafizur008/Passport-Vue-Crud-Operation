<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <b>
              <h5>Search</h5>
            </b>
          </div>
          <div class="card-body">
            <input v-model="searchQuery" @input="search" class="form-control" placeholder="Search By Name, Department Or GPA">
            <div v-if="showError" class="alert alert-danger">
              {{ errorMessage }}
            </div>
            <table v-if="showTable" class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Department</th>
                  <th>GPA</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="result in filteredResults" :key="result.id">
                  <td>{{ result.name }}</td>
                  <td>{{ result.department_name }}</td>
                  <td>{{ result.gpa }}</td>
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
import 'toastr/build/toastr.css';
import toastr from 'toastr';

export default {
  name: "SearchMenu",
  data() {
    return {
      searchQuery: "",
      results: [],
      showTable: false,
      showError: false,
      errorMessage: "",
    };
  },
  computed: {
    filteredResults() {
      return this.results.filter(result => {
        const query = this.searchQuery.toLowerCase();
        return (
          result.name.toLowerCase().includes(query) ||
          result.department_name.toLowerCase().includes(query) ||
          result.gpa.toString().includes(query)
        );
      });
    },
  },
  methods: {
    async fetchResults() {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/v1/results");
        const responseData = await response.json();
        console.log("API Response:", responseData);

        if (responseData.results && Array.isArray(responseData.results)) {
          this.results = responseData.results;
        } else {
          this.showError = true;
          this.errorMessage = "API response is not format.";
          console.error("API response is not format.");
          toastr.error("API response is not format.");
        }
      } catch (error) {
        this.showError = true;
        this.errorMessage = "Error fetching data: " + error.message;
        console.error("Error fetching data: ", error);
        toastr.error("Error fetching data: " + error.message);
      }
    },
    search() {
      this.showTable = this.searchQuery.trim() !== '';
    },
  },
  mounted() {
    this.fetchResults();
  },
};
</script>
