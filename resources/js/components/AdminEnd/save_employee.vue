<template>
    <div>
      
 <div class="col-12 grid-margin">
    <router-link to="/view-employee"  class="mb-3 btn btn-outline-primary">View employees</router-link>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Employee</h4>
                    <form class="form-sample"  @submit.prevent="create">
                        <input type="hidden"  v-model="form.id" />
                      <p class="card-description"> Employee Information </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">First name *</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" v-model="form.first_name" />
                             <small class="text-danger" v-if="errors.first_name" >{{ errors.first_name[0] }}</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Last Name *</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" v-model="form.last_name" />
                             <small class="text-danger" v-if="errors.last_name" >{{ errors.last_name[0] }}</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">company name</label>
                            <div class="col-sm-8">
                             <select class="form-control" i v-model="form.company_id">
                        <option v-for="company in companies" :value="company.id" :key="company.id">{{company.name}}</option>
                             <small class="text-danger" v-if="errors.company_id" >{{ errors.company_id[0] }}</small>
                             </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" v-model="form.email" />
                             <small class="text-danger" v-if="errors.email" >{{ errors.email[0] }}</small>
                            </div>
                          </div>
                        </div>
                      </div>
                       <div class="row">
                          <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" v-model="form.phone" />
                             <small class="text-danger" v-if="errors.phone" >{{ errors.phone[0] }}</small>
                            </div>
                          </div>
                        </div>
                         <div class="col-md-6">
                          
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-success">Submit</button>
                      
                     
                    </form>
                  </div>
                </div>
              </div>       
    </div>
</template>

<script>
    export default {
        created()
        {
       this.getcompanies();
       
      this.id =  this.$route.params.employee_id;
       
       if(this.id!='')
       {


        axios.get('/api/employee/'+this.id)
       .then(response=>{
            const editdata = response.data;
            this.form = editdata;

            
            
       })
       .catch(error=>{

       })

       }
       
        },
        data()
        {
            return{
                form:{
                   first_name:null,
                   last_name:null,
                   company_id:null,
                   email:null,
                   phone:null,
                   id:null
                     },
                companies:{},
                id:'',
                errors:{}
            }
        },
        methods:{
             create()
      {
        
        axios.post('/api/employee',this.form)
        .then(resp=>{
        Toast.fire({
                 icon: 'success',
                 title: 'Successfully Saved'
                   });
                  
      //  Notification.success();
        /// this.$router.push({name: 'All-Category'})
 
        })
        .catch(error=>{
          this.errors = error.response.data.errors;
         Toast.fire({
                 icon: 'error',
                 title: 'Error Please Try Again'
                   });
        })
      },
            onChange(e)
            {
                  const image = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.form.logo = e.target.result;
                    
                };
               
            },
            getcompanies()
            {
                 axios.get('/api/company')
       .then(response=>{
            this.companies = response.data;
            })
       .catch(error=>{

       })

            
            
       
            }
       
    }
    }
</script>
