<template>
    <div>
      
   <router-link to="/save-employee"  class="mb-3 mx-3 btn btn-outline-primary">Add Employee</router-link>
               <div class="col-lg-12 grid-margin stretch-card">
                    
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Employees</h4>
                    <div class="row">
                    <div class="col-md-6" style="display: none">
                     <input type="text" v-model="searchTerm" placeholder="Search Employee by Name" />
                    </div>
                    </div>
                   
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company Name</th>
                            <th>Phone</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(employee,idx) in employees.data" :key="idx">
                            <td class="py-1"> {{idx+1 }} </td>
                            <td> {{employee.first_name +' '+ employee.last_name}}  </td>
                            <td> {{employee.email}} </td>
                            <td> {{employee.companies.name}} </td>                
                            <td> {{employee.phone}} </td>
                            <td>
                            <button @click="deletedata(employee.id)" class="btn btn-danger-outline"><i class='fa fa-trash'></i></button>
                            <button class="btn btn-primary-outline"><router-link :to="{ name:'edit-employee', params:{employee_id:employee.id } }"><i class="fa fa-edit"></i></router-link></button>
                          </td>
                          </tr>
                        </tbody>
                        <tr>
 <pagination :data="employees" @pagination-change-page="getdata"></pagination>
                        </tr>
                         
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
        employees:[],
        errors:{},
        searchTerm:"",
      
          }
      },
 
methods:{
       deletedata(id)
      {
         
          swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You want to Delete this Employee",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
     axios.delete('/api/employee/'+id)
         .then(response=>{
            Toast.fire({
                 icon: 'success',
                 title: 'Successfully Removed'
                   });
             this.employees = this.employees.filter(employee => {
                  return employee.id != id
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
       getdata(page)
      {
        if (typeof page === 'undefined') {
                    page = 1;
                }
      
               
          axios.get("/api/employee?page="+page).then(response=>
          {
          this.employees = response.data;
          }).
          catch(error=>{
          console.log(error);
          });
      }
  }
}
</script>
