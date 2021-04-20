<template>
<div class="dashboard">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center ">
        <div class="d-flex justify-content-between">

        <div class="navbar-brand" href="#"> TIMELINE DASHBOARD</div>
      
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
                <router-link :class="['nav-link ']" to="/login">lOGIN</router-link >
            </li>
         
            <li class="nav-item">
                <router-link :class="['nav-link ']" to="/register">SIGN UP</router-link >
            </li>        
          </ul>
        </div>

        </div>
      </nav>
  <h1 class="content">Hello :)</h1>
        
</div>
</template>

<script> 


    export default {
        name: "dashboard",
        data: function () {
            return {
             

              
            };
        },
      
         
    }
</script>

