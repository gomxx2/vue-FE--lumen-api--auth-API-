<template>
  <div class="posts">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">add new CALLS</div>
            {{post}}
            <div class="card-body">
              <form @submit.prevent="PostStore">
                <div class="form-group">
                  <label>Subject</label>
                  <input  type="text" class="form-control" v-model="call.subject" placeholder="salutation"/>
                  <div v-if="validation.subject">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.subject[0] }}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <input
                    class="form-control"
                    v-model="call.Description"
                    rows="5"
                    placeholder="input Description Calls"
                  >
                  <div v-if="validation.Description">
                    <div class="alert alert-danger mt-1" role="alert">
                          {{ validation.Description[0] }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Status Call</label>
                  <textarea
                    class="form-control"
                    v-model="call.status_call"
                    rows="5"
                    placeholder="Input Status Calls Now"
                  ></textarea>
                  <div v-if="validation.status_call">
                    <div class="alert alert-danger mt-1" role="alert">
                      
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Status Direction</label>
                  <textarea
                    class="form-control"
                    v-model="call.status_direction"
                    rows="5"
                    placeholder="Input Status direction"
                  ></textarea>
                  <div v-if="validation.status_direction">
                    <div class="alert alert-danger mt-1" role="alert">
                      
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                  <label>Parent Type</label>
                  <textarea
                    class="form-control"
                    v-model="call.Parent_type"
                    rows="5"
                    placeholder="input Parent Type who"
                  ></textarea>
                  <div v-if="validation.Parent_type">
                    <div class="alert alert-danger mt-1" role="alert">
                      
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                  <label>Relate</label>
                  <textarea
                    class="form-control"
                    v-model="call.relate"
                    rows="5"
                    placeholder="input Relate"
                  ></textarea>
                  <div v-if="validation.relate">
                    <div class="alert alert-danger mt-1" role="alert">
                      
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                  <label>Start Date</label>
                  <textarea
                    class="form-control"
                    v-model="call.start_date"
                    rows="5"
                    placeholder="input Start Date"
                  ></textarea>
                  <div v-if="validation.start_date">
                    <div class="alert alert-danger mt-1" role="alert">
                      
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                  <label>calls Owner</label>
                  <textarea
                    class="form-control"
                    v-model="call.calls_owner"
                    rows="5"
                    placeholder="input Calls Owner"
                  ></textarea>
                  <div v-if="validation.calls_owner">
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
              &nbsp;&nbsp;
                <router-link to='/'  class="btn btn-md btn-info">CANCEL</router-link>
                
                
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
      call: {},
      validation: [],
    };
  },
  methods: {
    //menggunakan axios
    PostStore() {
      axios
        .post("http://localhost:9001/calls", this.call)
        .then((response) => {
            this.CallRelationStore() 
             this.$router.push({
            name: "karyawan",
          });

          console.log(response.data.data);
           
        })
        
        .catch((error) => {
          this.validation = error.response.data.data;
        });
           
    },

    CallRelationStore(){
         fetch("http://localhost:9001/relation", {
        method: "post",
        headers: {
          "Content-Type": "application/json",
        },
        //masukan data dari code
        body:JSON.stringify({
            id_contact:this.$route.params.id_contact,
            id_calls:777,         
        })       
      })
    },
    
    simpanFetch() {
      fetch("http://localhost:9001/calls", {
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
            name: "calls",
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