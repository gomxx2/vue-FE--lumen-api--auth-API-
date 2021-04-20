<template>
<div class="register">
    <div class="row">
            <!-- <div class="col-xl-"></div> -->
             <div class="col-xl-5 left-box text-center">
                 <h1 class="p-10">
                        Daftar Sekarang dan Mulai Gratis Trial 7 Hari Anda
                 </h1>
              
                 </div>
            <div class="card card-signin col-xl-7 right-box">
                <div class="">
                    <div class="card-body">
                         <h3 class="card-title text-center">FREE</h3>
                        <h5 class="card-title text-center">Sign up now</h5>
                       
                        <form class="form-login" v-on:submit.prevent="onRegister">
                            <div class="form-label-group">
                                <p>Email address</p>
                                <input v-model="register_user.email" type="email" id="inputEmail" class="form-control"
                                    placeholder="Email address" autofocus>
                                  
                            </div>
 
                            <div class="form-label-group">
                                <p>Password</p>
                                <input v-model="register_user.password" type="password" id="inputPassword" class="form-control"
                                    placeholder="Password" required>
                                       
                            </div>
                             <div class="form-label-group">
                                <p>Confirm Password</p>
                                <input v-model="register_user.confirm_password" type="password" id="inputPassword" class="form-control"
                                    placeholder="Password" required>
                            </div>
                                    <div v-html="ini"></div>
                                    <br>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign up</button>
                             <div v-if="validation.confirm_password">
                                <div class="alert alert-danger mt-1" role="alert">
                                  {{validation.confirm_password[0]}}
                                </div>
                            </div>
                              
                             <div class="d-flex justify-content-center">
                         
                                   <router-link :class="[]" to="/dashboard">Back to Dashboard</router-link >
                                  
                            </div>

                            
                        
                        </form>
                    </div>
                </div>
            </div>
    </div>
        
</div>
</template>

<script> 
import axios from "axios";

    export default {
        name: "register",
        data: function () {
            return {
                register_user: {},
                validation:{},
               ini:'',

              
            };
        },
        methods: {         
            onRegister() {
                    
            axios.post('http://localhost:8000/register',this.register_user)
          .then((response) => {
          this.$router.push({
            name: "login",
          });
          console.log(response);           
        })
                //   this.$router.push({
                //     name: "dashboard",
                //     })
                                   
                .catch((error) => {
                this.validation = error.response.data.error;   
                      console.log(this.validation)
                });
                
                
            }
            
        },
    }
</script>
