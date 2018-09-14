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
					  		<div> <span>{{scope.row.name}}</span></div>
					  	</template>
					</el-table-column> 

				 	<el-table-column label="Description" width="200">
					  	 <template slot-scope="scope"> 
					  	 	<div> <span>{{scope.row.description}}</span></div>
					  	 </template>
					</el-table-column>

				    <el-table-column label="User" width="100"> 
						<template slot-scope="scope">
					  		<div> <span>{{scope.row.user}}</span></div>
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
					  		<el-button type="success" icon="el-icon-check" circle></el-button>
					  		<!--<el-button type="danger" icon="el-icon-close"  circle></el-button>-->
					  	</template>
				  </el-table-column>

		 		  <el-table-column label="Actions"> 
		 		  	<template slot-scope='scope'>
		 		  		<el-button type="primary" icon="el-icon-edit" circle></el-button>
		 		  		<!--<el-button type="info" icon="el-icon-view" circle></el-button>-->
		 		  		<el-button type="danger" icon="el-icon-delete" circle></el-button>
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

export default{

		name: 'AllRequisitions',


	 components:{
	 	'app-add-requisition_modal': AddNewRequisition,
	 	
	 },


		data() {
	        return {
			    addRequisitionModal:false,

			    allRequisitionData: [
				 {
		            name: 'Pencile',
		            description: 'Nothing to say',
		            user: 'MAK',
		            total_products: 60,
		            date: '10/04/2018'
		          },

		          {
		            name: 'Pen',
		            description: 'Nothing to say',
		            user: 'Rumel',
		            total_products: 80,
		            date: '16/05/2014'
		          }, 

		          {
		            name: 'Marker',
		            description: 'Nothing to say',
		            user: 'Lahin',
		            total_products: 40,
		            date: '18/06/2013'
		          }, 

		          {
		            name: 'Mouse',
		            description: 'Nothing to say',
		            user: 'Ruhel',
		            total_products: 45,
		            date: '13/08/2015'
		          }
	          ],
	          active_menu: ''
	        }
 	    },

 	    created(){
		},
	    
	    methods:{


		    addRequisitionItem(add){
				jQuery.post(ajaxurl, {
					action: 'ninja_inventory_ajax_actions',
					route: 'add_requisition',
					name: add.name,
					description: add.description,
					totalProducts:	add.totalProducts
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
						// this.fetchTables();
	                }
				)
			
			},







	  

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



