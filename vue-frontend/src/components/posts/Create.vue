<template>
  <div class="posts">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">add new contact</div>
            <!-- {{post}} -->
            <div class="card-body">
              <form @submit.prevent="simpanFetch">
                <div class="form-group">
                  <label>Salutation</label>
                  <input  type="text" class="form-control" v-model="post.salutation" placeholder="salutation"/>
                  <div v-if="validation.salutation">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.title[0] }}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Name</label>
                  <textarea
                    class="form-control"
                    v-model="post.first_name"
                    rows="5"
                    placeholder="input name"
                  ></textarea>
                  <div v-if="validation.first_name">
                    <div class="alert alert-danger mt-1" role="alert">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <textarea
                    class="form-control"
                    v-model="post.email"
                    rows="5"
                    placeholder="input email"
                  ></textarea>
                  <div v-if="validation.email">
                    <div class="alert alert-danger mt-1" role="alert">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                  <textarea
                    class="form-control"
                    v-model="post.mobile_numb"
                    rows="5"
                    placeholder="input phone number"
                  ></textarea>
                  <div v-if="validation.mobile_numb">
                    <div class="alert alert-danger mt-1" role="alert">
                      
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-md btn-success mr-2">
                  SIMPAN
                </button>
                <button type="reset" class="btn btn-md btn-danger">
                  RESET
                </button>
              </form>
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
      post: {},
      validation: [],
    };
  },
  methods: {
    //menggunakan axios
    PostStore() {
      axios
        .post("http://localhost:9001/contact", this.post)
        .then((response) => {
          this.$router.push({
            name: "karyawan",
          });
          console.log(response.data.data);
        })
        .catch((error) => {
          this.validation = error.response.data.data;
        });
    },
    simpanFetch() {
      fetch("http://localhost:9001/contact", {
        method: "post",
        headers: {
          "Content-Type": "application/json",
        },
        //masukan data dari code
        // body:JSON.stringify({
        //      salutation:'test fetch',
        //     first_name:'tes 3',
        //     email:'okeh@yahoo.com',
        //     mobile_numb:'996'
        // })
        //masukan data dari ui/ux
        body: JSON.stringify(this.post),
      })
        .then((response) => response.json())
        .then((response) => {
          this.$router.push({
            name: "karyawan",
          });
          console.log(response.data.data);
        })
        .catch((error) => {
          this.validation = error.response.data.data;
        });
    },
  },
};
</script>