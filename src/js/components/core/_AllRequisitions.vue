<template>
	
	<el-container class="all_requisitions">	
	
		 <el-header>
	    	<h2 class="inventory_titile"> All Requisition </h2>

	    	<div class="action_section">
				<label> <el-input placeholder="Search Title" suffix-icon="el-icon-search" size="small"></el-input></label>
				<el-button @click="addRequisitionModal=true" type="primary" size="small">Add New Requisition</el-button>
			</div>

	    </el-header>

    	<el-main>

    		<!-- All Product Table -->
    		<el-table
			    ref="multipleTable"
			    style="width: 100%"
			    :data="allRequisitionData"
			    border>
		    
				    <el-table-column type="selection"  width="55"> </el-table-column> 
					
					<el-table-column label="Title" width="120"> 
						<template slot-scope="scope"> 
					  		<div> <span>{{scope.row.title}}</span></div>
					  	</template>
					</el-table-column> 

				 	<el-table-column label="Description" width="200">
					  	 <template slot-scope="scope"> 
					  	 	<div> <span>{{scope.row.description}}</span></div>
					  	 </template>
					</el-table-column>

				    <el-table-column label="User" width="100"> 
						<template slot-scope="scope">
					  		<div> <span>{{scope.row.userId}}</span></div>
					  	</template>
				    </el-table-column>


				 	<el-table-column label="Total Products" width="120">
					  	<template slot-scope="scope">
					  		<div><span>{{scope.row.total_products}}</span></div>
					  	</template>
					</el-table-column>


					<el-table-column label="Date" width="100"> 
				  		<template slot-scope="scope">
				  			<div> <span>{{scope.row.date}}</span></div>
				  		</template>
					</el-table-column>

				  <el-table-column label="Status" width="100">
						<template slot-scope='scope'>
					  		<el-button v-if="status === '{scope.row.status}' " type="success" icon="el-icon-check" circle></el-button>
					  		<el-button v-else type="danger" icon="el-icon-close"  circle></el-button>
					  	</template>
				  </el-table-column>

		 		  <el-table-column label="Actions"> 
		 		  	<template slot-scope='scope'>
		 		  		<el-button type="primary" icon="el-icon-edit" circle></el-button>
		 		  		<app-delete-requisition
							@delete="deleteRequisition(scope.row.id)"> </app-delete-requisition>
					</template>
		 		  </el-table-column>
			</el-table>
		</el-main>



		<app-add-requisition_modal
			:addRequisitionModal="addRequisitionModal"
			@addRequisitionItem="addRequisitionItem($event)"></app-add-requisition_modal>


	</el-container>

</template>



<script>
	
	import AddNewRequisition from './_AddNewRequisition.vue'
	import DeleteTable from './DeleteTable.vue'

export default{

		name: 'AllRequisitions',


	 components:{
	 	'app-add-requisition_modal': AddNewRequisition,
	 	'app-delete-requisition': DeleteTable
	 },


		data() {
	        return {
			    addRequisitionModal:false,
				allRequisitionData: [],
	          	active_menu: '',
	          	status: '0'
	        }
 	    },

 	    created(){
 	    	this.fetchRequisitions();
		},
	    
	    methods:{

			fetchRequisitions(){

				let fetchRequisitionAjaxData = {
					action: 'ninja_inventory_ajax_actions',
					route: 'get_requisitions',
					// per_page: '10',
					// page_number: '1',
				};

				jQuery.get(ajaxurl, fetchRequisitionAjaxData)
					.then(
						 (response) => {
	                        console.log(response)
	                        this.allRequisitionData = response.data.allRequisitions;
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


		    addRequisitionItem(add){
				jQuery.post(ajaxurl, {
					action: 'ninja_inventory_ajax_actions',
					route: 'add_requisition',
					title: add.title,
					description: add.description,
					requisition_products: add.requisition_products,
					total_products: add.total_products
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
	                    this.addRequisitionModal = false;
						// this.addingTableAjax = false;
						this.fetchRequisitions();
	                }
				)
			
			},


			deleteRequisition(id){
				let deleteAjaxData = {
					action: 'ninja_inventory_ajax_actions',
					route: 'delete_requisition',
					requisitionId : id
				}
				jQuery.post(ajaxurl, deleteAjaxData)
				 .then(
				   (response) => {
				   	console.log(response);
				   	this.$notify.success({
				   		title: 'Deleted',
				   		message: response.data.message
				   	})
				   	this.fetchRequisitions();
				 })
			}

		},

	    watch:{

	    }


}


</script>





<style lang="scss">
	
.all_requisitions{
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



