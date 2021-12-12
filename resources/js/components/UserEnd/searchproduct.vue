

<template>
<div class="page-content-product">
         <div class="main-product">
            <div class="container">
               <div class="row clearfix">
                  <div class="find-box">
                     <h1>Find your next product or<br>business partner here.</h1>
                     <h4>It has never been easier.</h4>
                     <div class="product-sh">
                        <div class="col-sm-6">
                           <div class="form-sh">
                              <input type="text" placeholder="Search something you love" >
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-sh">
                              <select class="selectpicker">
                                 <option>Textiles</option>
                                 <option>Furniture</option>
                                 <option>Leather</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-sh"> <a class="btn" href="#">Search</a> </div>
                        </div>
                        <p>Or simply<a href="#"> click here </a> and get inspired!</p>
                     </div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div v-for="product in products" :key="product.id" class="col-lg-3 col-sm-6 col-md-3">
                     <a href="productpage.html">
                        <div class="box-img">
                           <h4>{{ product.title }}</h4>
                           <img src="" alt="sads" />
                        </div>
                     </a>
                  </div>
                  
                  
                  
                
                
                  
                 <br>
                  <div class="categories_link">
                     <a href="#">Browse all categories here</a>
                  </div>
               </div>
            </div>
         </div>
      </div>    
</template>

<script>
    export default {
       data()
       {
          return{
             products:{}
          }
       },
        mounted() {
        this.getproducts()   
              },
        methods:{
           getproducts()
           {
              axios.get("/api/productindex1").then(response=>
          {
      
          this.products = response.data;
          console.log(this.products);
          }).
          catch(error=>{
          console.log(error);
          });

           }
        }
    }
</script>
