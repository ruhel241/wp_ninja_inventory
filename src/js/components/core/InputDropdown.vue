<template>
    <div class="ninjaRecipeInputDropdown" :style="styleObj">
        <label>{{ label }}</label><br>
        <el-select v-model="model" :placeholder="pcHolder" class="model_select" style="width: 100%;">
            <el-option 
                v-for="(type, i) in recipeTypes"
                :key="i"
                :label="type.label"
                :value="type.value"></el-option>
        </el-select>
    </div>
</template>

<script>
export default {
    name: 'InputDropdown',
    props: {
        value: {
            default: ''
        },
        pcHolder: {
            default: '',
        },
        recipeTypes: {
            default: ''
        },
        label: {
            default: ''
        },
        styleObj: {
            default: ''
        }
    },
    computed: {
        model: {
            get() {
                return this.value
            },
            set(newValue) {
                this.$emit('input', newValue)
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.ninjaRecipeInputDropdown {
    .model_select {
        top: 5px;
    }
}
</style>

