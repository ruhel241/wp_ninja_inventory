<template>
	<div class="wp-ninja-all-products">
		

		 <!-- Header -->
        
        <div class="row clearfix ninja_inventory_header">
	         	<div class="title_section">
	         		<h2>Inventory Managemant Software</h2>
				</div>
				
		</div>
		<hr>


		<el-container>
		  <el-aside width="200px">

		  	<el-menu
		      background-color="#545c64"
             :default-active="active_menu"
             text-color="#fff"
             active-text-color="#ffd04b">
		     
			    <el-submenu index="1">
			        <template slot="title">
			          <i class="el-icon-location"></i>
			          <span> All Products </span>
			        </template>
					<el-menu-item @click="active_menu='add_new_product'" index="add_new_product">Add New Product</el-menu-item>
			        <el-menu-item @click="active_menu='print'" index="print">Print Product</el-menu-item>
			   </el-submenu>


		      <el-menu-item index="2">
		        <i class="el-icon-menu"></i>
		        <span>Navigator Two</span>
		      </el-menu-item>

		     

		    </el-menu>


		  </el-aside>

		  <el-container>
			    <el-header>
			    	<h2 class="inventory_titile">All Products</h2>

			    	<div class="action_section">
						<label> <el-input placeholder="Search Title" suffix-icon="el-icon-search" size="small"></el-input></label>
						<el-button @click="addTableModal=true" type="primary" size="small">Add Table</el-button>
					</div>

			    </el-header>

		    	<el-main>

		    		<!-- All Product Table -->
		    		<el-table
					    ref="multipleTable"
					    style="width: 100%"
					    :data="tableData"
					    border>
				    
						    <el-table-column type="selection"  width="55"> </el-table-column> 

						
						  <el-table-column prop="name" label="Product Name" width="200">  </el-table-column> 

						  <el-table-column prop="description" label="Description" width="300"> </el-table-column>

						  <el-table-column prop="quantity" label="Quantity" width="200"> </el-table-column>

						  <el-table-column prop="alert" label="Alert" width="200">
								<template slot-scope='scope'>
							  		<el-button type="success" size="mini"> Alert </el-button>
							  	</template>
						  </el-table-column>

				 		  <el-table-column pop="actions" label="Actions"> 
				 		  	<template slot-scope='scope'>
				 		  		<el-button type="success" size="mini"> Edit </el-button>
				 		  		<el-button type="danger" size="mini"> Delete </el-button>
				 		  	</template>
				 		  </el-table-column>
				
					</el-table>



		    	</el-main>













		    <!--  <el-footer>Footer</el-footer> -->
		  </el-container>

		</el-container>

































		



	<app-add-table
		:addTableModal="addTableModal"></app-add-table>

		


	</div>
</template>

 <script>
   
   import AddTable from '../core/_AddTable.vue'


export default {

    name: 'AllTables',
    components:{
		'app-add-table': AddTable
    },

	data() {
        return {
		    addTableModal:false,


		    tableData: [
			 {
	            name: 'Pencile',
	            description: 'Nothing to say',
	            quantity: 150
	          },

	          {
	            name: 'Pen',
	            description: 'Nothing to say',
	            quantity: 10
	          }, 

	          {
	            name: 'Marker',
	            description: 'Nothing to say',
	            quantity: 20
	          }, 

	          {
	            name: 'Mouse',
	            description: 'Nothing to say',
	            quantity: 30
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
	.update-nag{
		display:none;
	}
	.wp-ninja-all-products{
		.ninja_inventory_header{
			.title_section{
				display:inline-block;
				color:#40484E;
			}
			
		}

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
	  
	    .el-aside {
		    background-color: #495258;
		    color: #fff;
		    text-align: center;
		    line-height: 200px;
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

		.is-active{
			background-color:#3B4146 !important;
		}
  
  // body > .el-container {
  //   margin-bottom: 40px;
  // }
  
  // .el-container:nth-child(5) .el-aside,
  // .el-container:nth-child(6) .el-aside {
  //   line-height: 260px;
  // }
  
  // .el-container:nth-child(7) .el-aside {
  //   line-height: 320px;
  // }











	}

</style>
