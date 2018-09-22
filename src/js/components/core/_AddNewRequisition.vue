<template>
	
	<el-dialog
	title="Add New Requisition"
	:visible.sync="addRequisitionModal"
	width="40%">	


		<div class="add-requisition-fields">

            <div class="requisition_title">
                <label for="title">Name:</label>
                <el-input v-model="title" id="title" type="text" placeholder="Your requisition Name" ></el-input>
            </div>

            <div class="requisition_desc">
                <label for="description">Description:</label>
                <el-input v-model="description" id="description" type="textarea" :rows="5"  placeholder="Description"></el-input>
            </div>
			
			<div class="requisition_product">
                <label for="product">Product:</label>
               
				<div class="select_requisitionProduct">
					
					<el-row :gutter="10" v-for="(product, index) in products" :key="index"> 
						<el-col :span="9"> 
							<el-select v-model="product.product" filterable placeholder="Select Product" size="medium" class="select_product"> 
								<el-option 
									v-for="item in selects_products" 
									:key="item.value" 
									:label="item.label"
									:value="item.value"> 
								</el-option>
							</el-select>
						</el-col>

						<el-col :span="10"> 
							<el-input v-model="product.quantity" id="quantity" type="number" placeholder="Enter requisition Quantity" size="medium"></el-input>
						</el-col>

						<el-col :span="1"> 
							<el-button type="danger" icon="el-icon-delete" plain @click="deleteProduct(index)" size="medium"></el-button>
						</el-col>
					</el-row>


					<div class="addButtonProduct"> 
						<el-button type="success" icon="el-icon-circle-plus-outline" plain @click="addMoreProduct" size="medium"></el-button>
					</div>

                </div>
               
			</div>

       
		</div>


		<span slot="footer" class="dialog-footer">
			<!-- <div class="continue_adding_requisition">
	            <el-checkbox> Continue Adding </el-checkbox>
	         </div>
 -->
			<el-button>Cancel</el-button>
		    <el-button type="primary" @click="addRequisitionItem">Add Requisition</el-button>
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
				
			title: '',
			description:'',
			products:[
				{
					product: '', quantity: ''
				}
			],



		selects_products: [{
          value: 'pencile',
          label: 'Pencile'
        }, 
        {
          value: 'pen',
          label: 'Pen'
        }, 
        {
          value: 'marker',
          label: 'Marker'
        }, 
        {
          value: 'mouse',
          label: 'Mouse'
        }],
      

		}
	},


	methods:{

		addMoreProduct() {
			this.products.push({
				product: '',
				quantity: ''
			})
		},


		deleteProduct(index){
			this.products.splice(index, 1);
		},


		addRequisitionItem(){
			var addRequisitionData = {
				title: this.title,
				description: this.description,
				requisition_products:this.products,
				total_products: this.products.length
			};
				console.log(addRequisitionData);

			this.$emit('addRequisitionItem', addRequisitionData);
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
				// display:inline-block;
				.el-col{
					margin-bottom:5px;
				}
				.select_product{
					width:100%;
					input{
						background-color:#fff;
					}
				}

				#quantity{
					// margin-top:5px;
					// width:50%;
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














