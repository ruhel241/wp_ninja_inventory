<template>
    <div>
        <label v-if="label">{{ label }}</label>
        <input type="number" :placeholder="pcHolder" v-model="model" class="ing_amnt_field">
    </div>
</template>

<script>
export default {
    name: 'InputNumber',
    props: {
        value: {
            default: ''
        },
        pcHolder: '',
        label: {
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

<style scoped>
.ing_amnt_field {
    width: 100%;
    padding: 19px;
    border-radius: 4px;
}
</style>
