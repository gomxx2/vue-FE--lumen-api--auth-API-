<template>
  <div class="posts">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center">
        <div class="navbar-brand" href="#"> TIMELINE</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Contact <span class="sr-only">(current)</span></a>
            </li>
         
            <li class="nav-item">
                <router-link :class="['nav-link ']" to="/calls">Calls</router-link >
            </li>
            <li class="nav-item">
              
              <a class="nav-link"   @click.prevent="tokenDelete">LOGOUT</a>
            
            </li>
          </ul>
        </div>
      </nav>
    <div class="container mt-5">  
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="d-flex justify-content-between">
            <h1>CONTACT</h1>
            <router-link :class="['btn btn-outline-warning']" to="/create">create new</router-link >
          </div>
          <div class="card-body">
            <div class="table-responsive mt-2">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>email</th>
                    <th>Phone Number</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <tr v-for="contact in cnt" :key="contact.id">
                    <td>
                         <router-link :to="{name: 'edit',params: { kode_tertentu: contact.id }, }" class="give some unique css here or boostrap"> 
                        {{ contact.salutation }} {{ contact.first_name }}</router-link>
                    </td>
                    <td>{{ contact.email }}</td>
                    <td>{{ contact.mobile_numb }}</td>
                    <!-- <td class="text-center"> -->
                      <!-- router link to page edit withparams -->
                      <!-- <router-link
                        :to="{
                          name: 'edit',
                          params: { kode_tertentu: contact.id },
                        }"
                        class="btn btn-sm btn-primary mr-2"
                        >EDIT</router-link
                      > -->
                      <!-- <button
                        @click.prevent="PostDelete(contact.id)"
                        class="btn btn-sm btn-danger"
                      >
                        HAPUS
                      </button> -->
                    <!-- </td> -->
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";

export default {
  data() {
    return {
      judul: "DATA",
      cnt: [],
    };
  },
  created() {
    // axios.get('http://localhost:8000/posts')
    // .then(response => {this.posts = response.data.data;
    //   });
    fetch("http://localhost:9001/contact")
      .then((response) => response.json())
      
      .then((data_nya) => (this.cnt = data_nya.data));
      console.log(this.cnt.email)
  },
  methods: {

    tokenDelete(){           
        this.$router.push({
                name: "login",
              });
              localStorage.removeItem('token')         
    },
    PostDelete(id) {
      axios
        .delete(`http://localhost:9001/contact/${id}`)
        .then((response) => {
          this.kry.splice(this.kry.indexOf(id), 1);
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>