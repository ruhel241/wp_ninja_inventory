<template>
<div>
    <el-row style="float: left">
        <el-col :span="10" style="width: 100%; padding-right: 4px;"><br>
            <label>{{ field[0].label }} <span><el-switch v-model="field[0].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label>
            <input type="number" :placeholder="field[0].label" v-model="field[0].value" class="nutrition_fields" :disabled="field[0].disabled"><br>

            <label>{{ field[1].label }} <span><el-switch v-model="field[1].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[1].label" v-model="field[1].value" class="nutrition_fields" :disabled="field[1].disabled"><br>

            <label>{{ field[2].label }} <span><el-switch v-model="field[2].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[2].label" v-model="field[2].value" class="nutrition_fields" :disabled="field[2].disabled"><br>

            <label>{{ field[3].label }} <span><el-switch v-model="field[3].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[3].label" v-model="field[3].value" class="nutrition_fields" :disabled="field[3].disabled"><br>

            <label>{{ field[4].label }} <span><el-switch v-model="field[4].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[4].label" v-model="field[4].value" class="nutrition_fields" :disabled="field[4].disabled"><br>

            <label>{{ field[5].label }} <span><el-switch v-model="field[5].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[5].label" v-model="field[5].value" class="nutrition_fields" :disabled="field[5].disabled"><br>

            <label>{{ field[6].label }} <span><el-switch v-model="field[6].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[6].label" v-model="field[6].value" class="nutrition_fields" :disabled="field[6].disabled"><br>

            <label v-if="field[7].label!='' ">{{ field[7].label }} <span><el-switch v-model="field[7].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input v-if="field[7].label!='' " type="number" :placeholder="field[7].label" v-model="field[7].value" class="nutrition_fields" style="width: 100%;" :disabled="field[7].disabled"><br>
            
            <label v-if="field[8].label!='' ">{{ field[8].label }} <span><el-switch v-model="field[8].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input v-if="field[8].label != ''" type="number" :placeholder="field[8].label" v-model="field[8].value" class="nutrition_fields" style="width: 100%;" :disabled="field[8].disabled"><br>
            
            <label v-if="field[9].label != '' ">{{ field[9].label }} <span><el-switch v-model="field[9].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input v-if="field[9].label != '' " type="number" :placeholder="field[9].label" v-model="field[9].value" class="nutrition_fields" style="width: 100%;" :disabled="field[9].disabled"><br>
        </el-col>
    </el-row>
</div>
</template>


<script>
export default {
    name: 'NutritionFields',
    props: [
        'field'
    ],
    watch: {
        field: {
            handler(newValue) {
                this.$emit('input', newValue)
            },
            deep: true
        }
        
    }
}
</script>

<style scoped>
.nutrition_fields {
    width: 100%;
    padding: 18px;
    border-radius: 4px;
    margin-top: 7px;
    margin-bottom: 7px;
}
</style>

