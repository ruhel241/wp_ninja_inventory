<template>
	<div class="wp-ninja-inventory-mangement">
		

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
				          <span> Products </span>
				        </template>
						<el-menu-item @click="select_page='all_products'" index="all_products"> All Product</el-menu-item>
						<el-menu-item @click="addProductModal=true" index="add_new_product">Add New Product</el-menu-item>
				        <el-menu-item index="print">Print Product</el-menu-item>
				   </el-submenu>
				
				   <el-submenu index="2">
				        <template slot="title">
				          <i class="el-icon-menu"></i>
				          <span> Requisitions </span>
				        </template>
						<el-menu-item @click="select_page='all_requisitions'" index="all_requisitions">All Requisition</el-menu-item>
						<el-menu-item  @click="addRequisitionModal=true" index="add_new_requisition">Add New Requisition</el-menu-item>
				        <el-menu-item index="printss">Print Requisition</el-menu-item>
				   </el-submenu>

				</el-menu>
			</el-aside> 

		
		  
 				<template v-if="select_page == 'all_products' ">
 					<!-- All Products -->
			  		<app-all-products> </app-all-products>
				</template>
			
				<template v-if="select_page == 'all_requisitions' ">
				   <!-- All Requisitions -->
				   <app-all-requisitions> </app-all-requisitions>
				</template>
		

		</el-container>




	<app-add-productmodal
		:addProductModal="addProductModal"></app-add-productmodal>

	<app-add-requisition_modal
	:addRequisitionModal="addRequisitionModal"></app-add-requisition_modal>

	


	</div>
</template>

 <script>
   
   import AddNewProduct from '../core/_AddNewProduct.vue'
   import AllProducts from '../core/_AllProducts.vue'
   import AllRequisitions from '../core/_AllRequisitions.vue'

   import AddNewRequisition from '../core/_AddNewRequisition.vue'


export default {

    name: 'InventoryManagement',
    components:{
    	'app-all-products': AllProducts,
		'app-add-productmodal': AddNewProduct,
		'app-all-requisitions': AllRequisitions,
		'app-add-requisition_modal': AddNewRequisition
    },

	data() {
        return {
		    addProductModal:false,
		    addRequisitionModal:false,
			active_menu: '',
			
			select_page:'all_products',
		   
        }
    },
    

}
  </script>





<style lang="scss">
	.update-nag{
		display:none;
	}
	
.wp-ninja-inventory-mangement{
	.ninja_inventory_header{
		.title_section{
			display:inline-block;
			color:#40484E;
		}
		
	}

	.el-aside {
	    background-color: #495258;
	    color: #fff;
	    text-align: center;
	    line-height: 200px;
 	}
	 
	.is-active{
		background-color:#3B4146 !important;
	}

	li{
		padding:0;
		margin:0;
	}

}

</style>
