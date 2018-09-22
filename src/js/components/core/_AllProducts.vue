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

						<el-table-column label="Product Name" width="120"> 
							<template slot-scope="scope">
						  		<div> <span>{{scope.row.product_name}}</span></div>
						  	</template>
						</el-table-column> 
						
						<el-table-column label="Description" width="250"> 
							<template slot-scope="scope">
						  		<div> <span>{{scope.row.description}}</span></div>
						  	</template>
						</el-table-column> 

						
						<el-table-column label="Quantity" width="100"> 
							<template slot-scope="scope">
						  		<div> <span>{{scope.row.quantity}}</span></div>
						  	</template>
						</el-table-column> 

						<el-table-column label="Date" width="130"> 
							<template slot-scope="scope">
						  		<div> <span>{{scope.row.date}}</span></div>
						  	</template>
						</el-table-column> 

					  <el-table-column label="Alert" width="80">
							<template slot-scope='scope'>
						  		<el-button type="success" icon="el-icon-check" circle></el-button>
						  		<!--<el-button type="danger" icon="el-icon-close"  circle></el-button>-->
						  	</template>
					  </el-table-column>

			 		  <el-table-column label="Actions" > 
			 		  	<template slot-scope='scope'>
			 		  		<el-button type="primary" icon="el-icon-edit" circle></el-button>
			 		  		<app-delete-product
							@delete="deleteProduct(scope.row.ID)"> </app-delete-product>

			 		  	</template>
			 		  </el-table-column>
			 		  
				</el-table>
			</el-main>

			<app-add-productmodal
			:addProductModal="addProductModal"
			@addNewProduct="addNewProduct($event)"></app-add-productmodal>

			

	</el-container>
	

</template>


<script>
	 import AddNewProduct from './_AddNewProduct.vue'
	 import DeleteTable from './DeleteTable.vue'
export default {

    name: 'AllProducts',
   
   	 components:{
    	'app-add-productmodal': AddNewProduct,
    	'app-delete-product': DeleteTable
	 },

	data() {
        return {
		    addProductModal:false,
			allProductData: [],
          	active_menu: ''
        }
    },
    created(){
		this.fetchTables(); // fetching the table data when application loads
	},
    methods: {

		fetchTables(){

			let fetchTablesAjaxData = {
				action: 'ninja_inventory_ajax_actions',
				route: 'get_tables',
				// per_page: '',
				// page_number: '',
			};

			jQuery.get(ajaxurl, fetchTablesAjaxData)
				.then(
					 (response) => {
                        console.log(response)
                        this.allProductData = response.data.tables;
                        // this.paginate.total = response.data.total;
                    }
				)
				.fail(
					(error) => {
                        this.$notify.error({
                            title: 'Error',
                            message: 'This is an error message'
                        });
                    }
				)
				.always(
					//  () => {
                    //     this.tableLoading = false
                    // }
				)
		},

		addNewProduct(add){
			console.log(add);
			jQuery.post(ajaxurl, {
				action: 'ninja_inventory_ajax_actions',
				route: 'add_table',
				product_name: add.product_name,
				description: add.description,
				quantity:	add.quantity
			}).then(
				response => {
					console.log(response);
					
                    this.$notify.success({
                        title: 'Success',
                        message: response.data.message
                    });
                    // this.$router.push({
                    //     name: 'edit_table',
                    //     params: {
                    //         table_id: response.data.table_id
                    //     }
                    // })
                }
			).fail(
				error => {
                    this.$notify.error({
                        title: 'Error',
                        message: error.responseJSON.data.message
                    });
                }
			).always(
				 () => {
                    this.addProductModal = false;
					// this.addingTableAjax = false;
					this.fetchTables();
                }
			)
		
		},
	  
		deleteProduct(tableId){
			let deleteAjaxData = {
				action: 'ninja_inventory_ajax_actions',
				route: 'delete_table',
				table_id: tableId
			}
			jQuery.post(ajaxurl, deleteAjaxData)
			  .then(
				(response) => {
					this.$notify.success({
						title: 'Deleted',
						message: response.data.message
					})
					this.fetchTables();
				}
			  )
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







