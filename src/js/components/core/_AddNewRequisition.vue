<template>
	
	<el-dialog
	title="Add New Requisition"
	:visible.sync="addRequisitionModal"
	width="40%">	


		<div class="add-requisition-fields">

            <div class="requisition_title">
                <label for="title">Name:</label>
                <el-input id="title" type="text" placeholder="Your requisition Name" ></el-input>
            </div>

            <div class="requisition_desc">
                <label for="description">Description:</label>
                <el-input id="description" type="textarea" :rows="5"  placeholder="Description"></el-input>
            </div>
			
			<div class="requisition_product">
                <label for="product">Product:</label>
               
				<div class="select_requisitionProduct">
                	<el-input id="select-product" type="text" placeholder="Select Product" size="medium"></el-input>
					<el-input id="quantity" type="number" placeholder="Enter requisition Quantity" size="medium"></el-input>
				</div>
               
			</div>

          <!--   <div class="requisition_quantity">
                <label for="quantity">Quantity:</label>
                <el-input id="quantity" type="number" placeholder="Enter requisition Quantity" size="medium"></el-input>
            </div> -->


		</div>


		<span slot="footer" class="dialog-footer">
			<div class="continue_adding_requisition">
	            <el-checkbox> Continue Adding </el-checkbox>
	         </div>

			<el-button @click="addRequisitionModal= false">Cancel</el-button>
		    <el-button type="primary" @click="addRequisitionModal= false">Add Requisition</el-button>
	    </span>



	</el-dialog>	



</template>



<script>
	
 export default{

	name: 'AddNewRquisition',

	components:{

	},

	data(){

		return {

		}
	},

	props:{
		addRequisitionModal:{
			default: false
		},
	}

 }


	

</script>


<style lang="scss">
	
.add-requisition-fields{
		.requisition_title{
			#title{
				margin-top:5px;
				margin-bottom:10px;
			}
		}
		.requisition_desc{
			#description{
				margin-top:5px;
				margin-bottom:10px;
			}
		}

		.requisition_product{
			
			.select_requisitionProduct{
				display:inline-block;
				#select-product{
					width:50%;
				}
				#quantity{
					// margin-top:5px;
					width:50%;
				}
			}

		}

	}


	.dialog-footer{
		.continue_adding_requisition{
			float:left;
		}

		.el-button--primary {
		    color: #fff;
		    background-color: #337ab7;
		    border-color: #2e6da4;
		}
	}

</style>














