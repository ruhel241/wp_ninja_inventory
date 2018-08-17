<template>

	<el-container class="ninja-all-products">	
	
			 <el-header>
		    	<h2 class="inventory_titile">All Products</h2>

		    	<div class="action_section">
					<label> <el-input placeholder="Search Title" suffix-icon="el-icon-search" size="small"></el-input></label>
					<el-button @click="addProductModal=true" type="primary" size="small">Add New Product</el-button>
				</div>

		    </el-header>

	    	<el-main>

	    		<!-- All Product Table -->
	    		<el-table
				    ref="multipleTable"
				    style="width: 100%"
				    :data="allProductData"
				    border>
			    
					    <el-table-column type="selection"  width="55"> </el-table-column> 

					
					  <el-table-column prop="name" label="Product Name" width="200">  </el-table-column> 

					  <el-table-column prop="description" label="Description" width="300"> </el-table-column>

					  <el-table-column prop="quantity" label="Quantity" width="200"> </el-table-column>
					  <el-table-column prop="date" label="Date" width="200"> </el-table-column>

					  <el-table-column prop="alert" label="Alert" width="200">
							<template slot-scope='scope'>
						  		<el-button type="success" icon="el-icon-check" circle></el-button>
						  		<el-button type="danger" icon="el-icon-close"  circle></el-button>
						  	</template>
					  </el-table-column>

			 		  <el-table-column pop="actions" label="Actions"> 
			 		  	<template slot-scope='scope'>
			 		  		<el-button type="primary" icon="el-icon-edit" circle></el-button>
			 		  		<el-button type="danger" icon="el-icon-delete" circle></el-button>
			 		  	</template>
			 		  </el-table-column>
				</el-table>
			</el-main>

			<app-add-productmodal
		:addProductModal="addProductModal"></app-add-productmodal>

	</el-container>
	

</template>


<script>
	 import AddNewProduct from './_AddNewProduct.vue'

export default {

    name: 'AllProducts',
   
   	 components:{
    	'app-add-productmodal': AddNewProduct
	 },

	data() {
        return {
		    addProductModal:false,


		    allProductData: [
			 {
	            name: 'Pencile',
	            description: 'Nothing to say',
	            quantity: 150,
	            date: '10/04/2018'
	          },

	          {
	            name: 'Pen',
	            description: 'Nothing to say',
	            quantity: 10,
	            date: '16/05/2014'
	          }, 

	          {
	            name: 'Marker',
	            description: 'Nothing to say',
	            quantity: 20,
	            date: '18/06/2013'
	          }, 

	          {
	            name: 'Mouse',
	            description: 'Nothing to say',
	            quantity: 30,
	            date: '13/08/2015'
	          }
          ],
          active_menu: ''
        }
    },
    created(){



    },
    methods:{

      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }


    },
    watch:{

    }




}
  </script>



<style lang="scss">
	
.ninja-all-products{
	// width:100%;

	.el-header, .el-footer {
	    background-color: #fff;
	    color: #333;
	    text-align: center;
	    line-height: 60px;
	    border-bottom: dashed 1px #ddd;
	    .inventory_titile {
	    	float:left;
	    	color:#40484E;
	    	margin:0
	    }
	    .action_section{
			float:right;
			label{
				display:inline-block;
			}
		}
	}

	.el-main {
	    background-color: #fff;
	    color: #333;
	    text-align: center;
	    // line-height: 160px;
  	}
	.cell{
	  	text-align:center;
	}

		
}
</style>







