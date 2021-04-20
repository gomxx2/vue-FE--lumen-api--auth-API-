
<template>

  <div class="posts">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center">
        <div class="navbar-brand" href="#"> TIMELINE</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item ">
              <router-link :class="['nav-link ']" to="/">Contact</router-link >
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
      <h2>{{kry.salutation}} {{kry.first_name}} Detail Information and Activity</h2>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">Detail Contact</div>
            
            <div class="card-body">
              <form @submit.prevent="PostUpdate">
                <div class="form-group">
                  <label>salutation</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="kry.salutation"
                    placeholder="Masukkan Title"
                  />
                  <div v-if="validation.salutation">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.first_name[0] }}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Name</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="kry.first_name"
                    placeholder="input name"
                  />
                  <div v-if="validation.first_name">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.first_name[0] }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>email</label>
                  <textarea
                    class="form-control"
                    v-model="kry.email"
                    rows="5"
                    placeholder="input email"
                  ></textarea>
                  <div v-if="validation.email">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.email[0] }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>phone Number</label>
                  <textarea
                    class="form-control"
                    v-model="kry.mobile_numb"
                    rows="5"
                    placeholder="input phone number"
                  ></textarea>
                  <div v-if="validation.mobile_numb">
                    <div class="alert alert-danger mt-1" role="alert">
                      {{ validation.mobile_numb[0] }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-md btn-success mr-2">
                    UPDATE
                  </button>
                  <button
                    @click.prevent="PostDelete(kry.id)"
                    class="btn btn-md btn-danger"
                  >
                    HAPUS
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-item nav-link disabled" href="#">Note</a>
                  <a class="nav-item nav-link" href="#">Call</a>
                  <a class="nav-item nav-link disabled" href="#">Meeting</a>
                  <a class="nav-item nav-link disabled" href="#">Deals</a>
                  <a class="nav-item nav-link disabled" href="#">Project</a>
                  <a class="nav-item nav-link disabled" href="#">Email</a>
                  <a class="nav-item nav-link disabled" href="#">Survey</a>
                  
                </div>
              </div>
            </nav>
           <h5 style="text-align:center">TIMELINE</h5>
                         <router-link :class="['btn btn-outline-warning']"  :to="{name:'callscreate', params: { id_contact: kry.id }, }">create new calls activity</router-link >

           
               <div v-bind="timeline.id"></div>

                  <pre>
                    {{timeline}}
                    </pre>  
                  <div v-for="(item, key) in timeline" :key="key">

                    <div class="card" style="width: parent;">
                      <div class="card-body">
                      <h1><strong></strong></h1>
                        <h5 class="card-title"> {{item.subject}}</h5>
                          <button
                          @click.prevent="deleteTimeline(item.id,kry.id)"
                          class="btn btn-sm btn-danger"
                        >
                          HAPUS 
                        </button>
                        <h6 class="card-subtitle mb-2 text-muted">{{item.start_date}}</h6>
                        <p class="card-text">{{item.Description}}</p>
                        <div class="flex justify-content-center">

                       <strong>
                         <span href="#" class="card-link"> {{item.status_call}}</span>
                         </strong> 
                        <!-- <span href="#" class="card-link"> {{item.Parent_type}}</span> -->
                        </div>
                           <br>
                            <tr>
                            <td>status Direction </td>
                            <td>: {{item.status_direction}}</td>
                          </tr>
                           
                            <tr>
                            <td>Relate </td>
                            <td>: {{item.relate}}</td>
                          </tr>
                            <tr>
                            <td>Start Date </td>
                            <td>: {{item.start_date}}</td>
                          </tr>                       
                            <tr>
                            <td>Calls Owner </td>
                            <td>: {{item.calls_owner}}</td>
                          </tr>        
                      </div>
                      <br><br>    
                    </div>
<div>

                       <!-- <tr>
                        <td>Subject: </td>
                        <td> {{item.subject}}</td>
                      </tr> -->
                      <!-- <tr>
                        <td>Description: </td>
                        <td> {{item.Description}}</td>
                      </tr> -->
                        <!-- <tr>
                        <td>status Call: </td>
                        <td>  {{item.status_call}}</td>
                      </tr> -->
                      <!-- <tr>
                        <td>status Direction: </td>
                        <td>  {{item.status_direction}}</td>
                      </tr> -->
                         <!-- <tr>
                        <td>Parent Type: </td>
                        <td>  {{item.Parent_type}}</td>
                      </tr> -->
                         <!-- <tr>
                        <td>Relate: </td>
                        <td>  {{item.relate}}</td>
                      </tr>
                        <tr>
                        <td>Start Date: </td>
                        <td>  {{item.start_date}}</td>
                      </tr>                       
                        <tr>
                        <td>Calls Owner: </td>
                        <td>   {{item.calls_owner}}</td>
                      </tr>        
                      <br><br>                   -->
</div>
                                                                                                                                                                                                                     
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
      kry: {},
      selected_timeline:'',
      timeline:{},
      validation: [],
     
    };
  },
  created() {
    axios
      .get(`http://localhost:9001/contact/${this.$route.params.kode_tertentu}`)
      .then((response) => {
        this.kry = response.data.data;
      });          
       this.viewtimeline();
  },

  methods: { 
     tokenDelete(){           
        this.$router.push({
                name: "login",
              });
              localStorage.removeItem('token')         
    },   
    viewtimeline(){
       axios
      .get(`http://localhost:9001/callstt?id=${this.$route.params.kode_tertentu}`)
      // this.$route.params.kode_tertentu
      .then((response) => {
        this.timeline = response.data.data;        
       })
      },

    PostUpdate() {
      axios
        .put(
          `http://localhost:9001/contact/${this.$route.params.kode_tertentu}`,
          this.kry
        )
        .then((response) => {
          this.$router.push({
            name: "karyawan",
          });
          console.log(response);
        })
        .catch((error) => {
          this.validation = error.response.data.data;
        });
    },
    PostDelete(id) {
         this.deleteAllTimeline(id) 
      axios
        .delete(`http://localhost:9001/contact/${id}`)
        .then((response) => {
          // ini next project >16 april        
          this.$router.push({
            name: "karyawan",
            
          });
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response);
        });
     
    },
    deleteAllTimeline(id_contact) {
      axios
        .delete(`http://localhost:9001/callstt/${id_contact}`)      
  },
     deleteTimeline(id_timeline) {
      axios
        .delete(`http://localhost:9001/calls/${id_timeline}`)
        .then((response) => {
          location.reload();          
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response);
        });
    }
  },
};
</script>