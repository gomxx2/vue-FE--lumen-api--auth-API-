<template>
  <div class="posts">
    
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Edit contact</div>
            <div class="card-body">
              <form @submit.prevent="PostUpdate">

                 <div class="form-group">
                  <label>subject</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="calls.subject"
                    placeholder="Masukkan Title"
                  />
                  <div v-if="validation.subject">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.subject[0] }}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="calls.Description"
                    placeholder="input name"
                  />
                  <div v-if="validation.Description">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.first_name[0] }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>status call</label>
                  <textarea
                    class="form-control"
                    v-model="calls.status_call"
                    rows="5"
                    placeholder="input email"
                  ></textarea>
                  <div v-if="validation.status_call">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.status_call[0] }}
                    </div>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label>parent type</label>
                  <textarea
                    class="form-control"
                    v-model="calls.Parent_type"
                    rows="5"
                    placeholder="input phone number"
                  ></textarea>
                  <div v-if="validation.Parent_type">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.Parent_type[0] }}
                    </div>
                  </div>
                </div> -->

                  <div class="form-group">
                  <label>Relate</label>
                  <textarea
                    class="form-control"
                    v-model="calls.relate"
                    rows="5"
                    placeholder="Relate"
                  ></textarea>
                  <div v-if="validation.Parent_type">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.Parent_type[0] }}
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                  <label>Start Date</label>
                  <textarea
                    class="form-control"
                    v-model="calls.start_date"
                    rows="5"
                    placeholder="input phone number"
                  ></textarea>
                  <div v-if="validation.start_date">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.Parent_type[0] }}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>calls owner</label>
                  <textarea
                    class="form-control"
                    v-model="calls.calls_owner"
                    rows="5"
                    placeholder="input phone number"
                  ></textarea>
                  <div v-if="validation.calls_owner">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.Parent_type[0] }}
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <button type="submit" class="btn btn-md btn-success mr-2">
                    UPDATE
                  </button>                    
                     <button
                        @click.prevent="PostDelete(calls.id)"
                        class="btn btn-md btn-danger"
                      >
                        HAPUS
                      </button>            
                </div>
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
     calls: {},
      validation: [],
        
    };
  },
 
  created() {
    axios
      .get(`http://localhost:9001/calls/${this.$route.params.kode_telpon}`)
      .then((response) => {
        this.calls = response.data;
        // console.log(this.calls.subject);
      });
     
  },
  methods: {
    PostUpdate() {
      axios
        .put(
          `http://localhost:9001/calls/${this.$route.params.kode_telpon}`,
          this.calls
        )
        .then((response) => {
          this.$router.push({
            name: "calls",
          });
          console.log(response);
        })
        .catch((error) => {
          this.validation = error.response.data.data;
          // console.log(error.response);
        });
    },
    PostDelete(id) {
      axios
        .delete(`http://localhost:9001/calls/${id}`)
        .then((response) => {
          this.$router.push({
            name: "calls",
          });
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>