<template>
	<el-dialog
	  title="Add New Product"
	  :visible.sync="addProductModal"
	  width="40%">
	  


		<div class="add-product-fields">

            <div class="product_title">
                <label for="title">Name:</label>
                <el-input v-model="title" id="title" type="text" placeholder="Your Product Name" ></el-input>
            </div>

            <div class="product_desc">
                <label for="description">Description:</label>
                <el-input v-model="description" id="description" type="textarea" :rows="5"  placeholder="Description"></el-input>
            </div>
			
			<div class="product_quantity">
                <label for="quantity">Quantity:</label>
                <el-input v-model="quantity" id="quantity" type="number" placeholder="Enter Product Quantity" size="medium"></el-input>
            </div>

        </div>


	  <span slot="footer" class="dialog-footer">
		<div class="continue_adding_product">
            <el-checkbox> Continue Adding </el-checkbox>
         </div>

		<el-button @click="addProductModal = false">Cancel</el-button>
	    <el-button type="primary" @click="addNewProduct">Add Product</el-button>
	  </span>
	</el-dialog>

</template>

<script>
	

export default{

  name: 'AddNewProduct',

  components:{

  },

	data(){
	  	return {
	  		title:'',
	  		description:'',
	  		quantity:''
	  	}
	},

	methods:{
		addNewProduct(){
			var addNewProducts = {
				name: this.title,
				description: this.description,
				quantity: this.quantity
			};
			console.log(addNewProducts);
		}
	},


	props:{
		addProductModal:{
			default: false
		},
	}


}

</script>




<style lang="scss">
	.add-product-fields{
		.product_title{
			#title{
				margin-top:5px;
				margin-bottom:10px;
			}
		}
		.product_desc{
			#description{
				margin-top:5px;
				margin-bottom:10px;
			}
		}

		.product_quantity{
			#quantity{
				margin-top:5px;
				width:50%;
			}
		}

	}


	.dialog-footer{
		.continue_adding_product{
			float:left;
		}

		.el-button--primary {
		    color: #fff;
		    background-color: #337ab7;
		    border-color: #2e6da4;
		}
	}


</style>













