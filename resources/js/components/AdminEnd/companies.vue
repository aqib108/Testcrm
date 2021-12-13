<template>
    <div>
      
   <router-link to="/save-company"  class="mb-3 mx-3 btn btn-outline-primary">Add Company</router-link>
               <div class="col-lg-12 grid-margin stretch-card">
                    
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Company</h4>
                    <div class="row">
                    <div class="col-md-6">
                     <input type="text" v-model="searchTerm" placeholder="Search Company by Name" />
                    </div>
                    </div>
                   
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th>company Name</th>
                            <th>email</th>
                            <th>website</th>
                            <th>logo</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(company,idx) in filtersearch" :key="idx">
                            <td class="py-1"> {{idx+1 }} </td>
                            <td> {{company.name}} </td>
                            <td> {{company.email}} </td>
                            <td> {{company.website}} </td>                
                            <td><img :src="company.logo" style="height: 90px; width: 80px" /></td>
                            <td>
                            <button @click="deletedata(company.id)" class="btn btn-danger-outline"><i class='fa fa-trash'></i></button>
                            <button class="btn btn-primary-outline"><router-link :to="{ name:'edit-company', params:{company_id:company.id } }"><i class="fa fa-edit"></i></router-link></button>
                          </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                  </div>
                </div>
              </div>    
    </div>
</template>

<script>
  
  export default {
   created()
    {
        this.getdata();

    },
data(){
    return{
        companies:[],
        errors:{},
        searchTerm:"",
      
          }
      },
  computed:{
    
filtersearch()
     {
    
        return this.companies.filter(company =>{
        return company.name.toLowerCase().match(this.searchTerm.toLowerCase())
        })
     }
  },
methods:{
       deletedata(id)
      {
         
          swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You want to Delete this Company",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
     axios.delete('/api/company/'+id)
         .then(response=>{
            Toast.fire({
                 icon: 'success',
                 title: 'Successfully Removed'
                   });
             this.companies = this.companies.filter(company => {
                  return company.id != id
                });
         })
         .catch(error=>{

         })
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
   
  }
})
        
      },
       getdata()
      {
          axios.get("/api/company").then(response=>
          {
               
          this.companies = response.data;
   
          }).
          catch(error=>{
          console.log(error);
          });
      }
  }
}
</script>
