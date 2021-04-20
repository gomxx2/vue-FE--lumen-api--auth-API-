<template>
<div class="login">
    <div class="row">
            <!-- <div class="col-xl-"></div> -->
             <div class="col-xl-5 left-box"></div>
            <div class="card card-signin col-xl-7 right-box">
                <div class="">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign in to your Account</h5>
                        <form class="form-login" v-on:submit.prevent="onLogin">
                            <div class="form-label-group">
                                <p>Email address</p>
                                <input v-model="user.email" type="email" id="inputEmail" class="form-control"
                                    placeholder="Email address" required autofocus>
                            </div>

                            <div class="form-label-group">
                                <p>Password</p>
                                <input v-model="user.password" type="password" id="inputPassword" class="form-control"
                                    placeholder="Password" required>
                            </div>
                                    <div v-html="ini"></div>
                                    <br>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                            <div class="d-flex justify-content-between">                               
                                 <router-link :class="[]" to="/register">Not registered? Create account</router-link >
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
        name: "Login",
        data: function () {
            return {
                user: {},
               ini:'',

              
            };
        },
        methods: {         
            onLogin() {
                    
            axios.post("http://localhost:8000/login", this.user)
           
            // .then((response) => {
            //      this.$router.push({
            //         name: "karyawan",
            //         })
                    .then(response=>{
                        console.log(response)
                         localStorage.setItem('token',response.data.token)
                         this.$router.push({
                                name: "karyawan",
                                     })
                                     if (localStorage.getItem('token') === 'undefined' || localStorage.getItem('token') === null) {
                                         
                             this.ini = '<div class="alert alert-danger mt-1" role="alert">wrong username or password</div>';
                         
                         }  
                               
                    })

                  // localStorage.setItem('username',JSON.stringify(response.data.username));   
                //  pentinkz  console.log(response.data.token);
                    
               
                .catch((error) => {
                this.validation = error.response.data.data;
                
                });
                
            }
            
        },
    }
</script>

<style scoped>
    .form-login input {
        margin-bottom: 5px;
    }
    .red {
        color: red;
        display: inline-block;
        width: 100%;
    }
</style>