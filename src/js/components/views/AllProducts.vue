<template>
	<div class="wp-ninja-all-products">
		

		 <!-- Header -->
        
        <div class="row clearfix ninja_inventory_header">
	         	<div class="title_section">
	         		<h1>All Products</h1>
				</div>
				<div class="action_section">
					<label> <el-input placeholder="Search Title" suffix-icon="el-icon-search" size="small"></el-input></label>
					<el-button @click="modal=true" type="primary" size="small">Add Table</el-button>
				</div>
		</div>
		<hr>



		<el-table
		    ref="multipleTable"
		    style="width: 100%"
		    :data="tableData"
		    border>
	    
		    <el-table-column type="selection"  width="55"> </el-table-column> 

		
		  <el-table-column prop="name" label="Product Name" width="300">  </el-table-column> 

		  <el-table-column prop="description" label="Description" width="400"> </el-table-column>

		  <el-table-column prop="quantity" label="Quantity" width="400"> </el-table-column>

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



		<el-dialog
		  title="Tips"
		  :visible.sync="modal"
		  width="30%">
		  <span>This is a message</span>
		  <span slot="footer" class="dialog-footer">
		    <el-button @click="modal = false">Cancel</el-button>
		    <el-button type="primary" @click="modal = false">Confirm</el-button>
		  </span>
		</el-dialog>


	</div>
</template>

 <script>
    export default {
      data() {
        return {

        	modal: false,

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
          ]
        }
      }
    }
  </script>





<style lang="scss">
	.wp-ninja-all-products{
		.ninja_inventory_header{
			.title_section{
				display:inline-block;	
			}
			.action_section{
				float:right;
				label{
					display:inline-block;
				}
			}
		}
	}

</style>
