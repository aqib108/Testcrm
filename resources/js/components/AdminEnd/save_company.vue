<template>
    <div>
      
 <div class="col-12 grid-margin">
    <router-link to="/view-company"  class="mb-3 btn btn-outline-primary">View Companies</router-link>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Company</h4>
                    <form class="form-sample"  @submit.prevent="create">
                        <input type="hidden"  v-model="form.id" />
                      <p class="card-description"> Company Information </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">company name*</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" v-model="form.name" />
                             <small class="text-danger" v-if="errors.name" >{{ errors.name[0] }}</small>
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
                            <label class="col-sm-4 col-form-label">website</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" v-model="form.website" />
                             <small class="text-danger" v-if="errors.website" >{{ errors.website[0] }}</small>
                            </div>
                          </div>
                        </div>
                         <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">company logo</label>
                            <div class="col-sm-8">
                              <input type="file" class="form-control" @change="onChange" accept="image/*"  />
                             <small class="text-danger" v-if="errors.image" >{{ errors.image[0] }}</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6"></div>
                      <div class="col-md-6">
                          
                           <img v-if="form.logo!=0" :src="form.logo" style="height: 50px; width: 50px" />
                             <img v-else :src="old_logo" style="height: 50px; width: 50px" />
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
       this.id =  this.$route.params.company_id;
       
       if(this.id!='')
       {


        axios.get('/api/company/'+this.id)
       .then(response=>{
            const editdata = response.data;
            this.old_logo = editdata.logo;
            editdata.logo=0;
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
                   name:null,
                   email:null,
                   website:null,
                   logo:null,
                   id:null
                },
                old_logo:null,
                id:'',
                errors:{}
            }
        },
        methods:{
             create()
      {
        
        axios.post('/api/company',this.form)
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
               
            }
       
    }
    }
</script>
