<template>
  <el-popover 
    placement="top" 
    width="160"
    v-model="isVisible">

    <p> Are you to delete this?</p>

    <div style="text-align: right; margin: 0">
      <el-button size="mini" type="text" @click="isVisible = false"> Cancel </el-button> 
       <el-button type="primary" size="mini" @click="confirm()">Confirm</el-button>
    </div>

    <el-button slot="reference" title="Delete" type="danger" icon="el-icon-delete" circle></el-button>

  </el-popover>

</template>

<script>
  export default {
    name: 'DeleteTable',
    data(){
      return {
        isVisible: false,
      };
    },
    methods:{
      confirm(){
        this.$emit('delete', true);
      }
    }
  }

</script>








