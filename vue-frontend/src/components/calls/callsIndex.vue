
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
         
            <li class="nav-item active">
                <router-link :class="['nav-link ']" to="/calls">Calls <span class="sr-only">(current)</span></router-link >
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
            <h1>Calls</h1>
            <router-link :class="['btn btn-outline-warning btn-lg']" to="/callscreateid">create new</router-link >
          </div>
          <div class="card-body">
            <div class="table-responsive mt-2">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Status Vall</th>
                    <th>Status Direction</th>
                    <!-- <th>Parent Type</th> -->
                    <th>Relate</th>
                    <th>Start Date</th>
                    <th>Calls Owner</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="calls in call" :key="calls.id">
                    <td>
                         <router-link :to="{name: 'callsEdit',params: { kode_telpon: calls.id }, }" class="give some unique css here or boostrap"> 
                        {{ calls.subject}} 
                        </router-link>
                    </td>
                    <td>{{ calls.Description }}</td>
                    <td>{{ calls.status_call }}</td>
                    <td>{{ calls.status_direction }}</td>
                    <!-- <td>{{ calls.Parent_type}}</td> -->
                    <td>{{ calls.relate}}</td>
                    <td>{{ calls.start_date}}</td>
                    <td>{{ calls.calls_owner}}</td>                    

                   <!-- u will looking at this comment if you ask me why cause this 
                   delate option and edit in every bar -->
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
              <!-- pagination -->
                  <p>Selected page: {{page}}</p>
                   <pagination :records="100" v-model="page" :per-page="1" @paginate="callback">
                  </pagination>

                  <!-- anoter pagination -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in getLists" v-bind:key="item.id">
                        <td>{{item.id}}</td>
                        <td>{{item.title}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <paginate
                    v-model="currentPage"
                    :page-count="getPageCount"
                    :initial-page="4"
                    :page-range="3"
                    :margin-pages="2"
                    :click-handler="clickCallback"
                    :prev-text="'＜'"
                    :next-text="'＞'"
                    :container-class="'pagination'"
                    :page-class="'page-item'">
                  </paginate>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
const items = [];

for(let i=1; i<=105; i++){
  items.push({
    id: i,
    title: 'item-'+i
  });
}
import axios from "axios";

export default {
  data() {
    return {
      judul: "DATA",
      call: {},
      page:45,
       select: this.$route.params.select ? decodeURI(this.$route.params.select) : '',
      items: items,
      parPage: 10,
      currentPage: this.currentPage = Number(this.$route.params.page) || 1                         
    };
  },    
  created() {
    // axios.get('http://localhost:8000/posts')
    // .then(response => {this.posts = response.data.data;
    //   });
    fetch("http://localhost:9001/calls")
      .then((response) => response.json())
      .then((data_nya) => (this.call = data_nya.data));
       
  },
    computed: {
    getItems: function() {
      let self = this;
      return this.items.filter(function(item){
        return String(item.id).indexOf(self.select) !== -1;
      })
    },
    getLists: function(){
      let current = this.currentPage * this.parPage;
      let start = current - this.parPage;

      return this.getItems.slice(start, current);
    },
    getPageCount: function() {
      return Math.ceil(this.getItems.length / this.parPage);
    }
  },
  methods: {
  clickCallback: function () {
      if(this.select != ''){
        this.$router.push({ 
          name: 'page-filter', 
          params: { 
            page: this.currentPage,
            select: encodeURI(this.select) 
          }
        });
      } else {
        console.log(111);
        this.$router.push({ 
          name: 'page', 
          params: { 
            page: this.currentPage 
          }
        });
      }     
    },
    //diatas pagination
     callback: function(page) {
      console.log(`Page ${page} was selected. Do something about it`);
    },
     tokenDelete(){           
        this.$router.push({
                name: "login",
              });
              localStorage.removeItem('token')         
    },
    PostDelete(id) {
      axios
        .delete(`http://localhost:9001/calls/${id}`)
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