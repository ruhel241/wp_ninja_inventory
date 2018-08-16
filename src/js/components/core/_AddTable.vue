<template>
	<el-dialog
	  title="Add New Product"
	  :visible.sync="addTableModal"
	  width="30%">
	  <span>This is a message</span>
	  <span slot="footer" class="dialog-footer">
	    <el-button @click="addTableModal = false">Cancel</el-button>
	    <el-button type="primary" @click="addTableModal = false">Confirm</el-button>
	  </span>
	</el-dialog>

</template>

<script>
	

export default{

  name: 'AddTable',

  components:{

  },

	data(){
	  	return {
	  		
	  	}
	},
	props:{
		addTableModal:{
			default: false
		},
	}


}







</script>