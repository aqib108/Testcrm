<template>
    <div>
        <searchproduct/>
        <catmain/>
       <product/>
       <starting/>
       <!-- <trending_product/> -->
    </div>
</template>

<script>
import searchproduct from './searchproduct.vue';
import catmain from './catmain.vue';
import product from './product.vue';
import starting from './starting.vue';
//import trending_product from './trending_product.vue';


    export default {
        components:{
            searchproduct,
            catmain,
            product,
            starting,
  //          trending_product

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
