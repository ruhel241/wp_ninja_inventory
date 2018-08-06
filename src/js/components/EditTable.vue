<template>
    <div class="ninja_recipe_table">
        
        <!-- Header -->
        <el-row class="header">
            <el-col :span="24">
                <el-col :span="20">
                    <h1>{{ post_title }}
                        <span>
                            <code class="copy" :data-clipboard-text='`[ninja_recipe id="${table_id}"]`' style="cursor: pointer;">
                                [ninja_recipe id="{{table_id}}"]
                            </code>
                        </span>
                    </h1>
                </el-col>
                <el-col :span="4" class="table_action_btn">
                    <el-button class="common_btn" @click="updateTableConfig" type="success">
                        Update
                    </el-button>
                    <a :href="demo_url" target="_blank" style="color: #fff; text-decoration: none;">
                        <el-button class="common_btn" type="primary">Preview</el-button>
                    </a>
                </el-col>
            </el-col>
        </el-row>

        <!-- Body -->
        <el-row>
            
            <el-col class="fields">
                <h2 v-if="recipe_type==='normal'">Normal Recipe</h2>
                <h2 v-if="recipe_type==='advance'">Advance Recipe</h2>

                <div class="change_type">
                    <el-select v-model="recipe_type" placeholder="Recipe Type">
                        <el-option
                            v-for="(type, i) in recipe_types"
                            :key="i"
                            :label="type.label"
                            :value="type.value"></el-option>
                    </el-select>
                </div>

                <div class="all_fields" v-if="recipe_type === 'normal'">
                    <el-tabs type="border-card" :stretch=stretch>

                        <el-tab-pane label="Introduction">
                            <app-wp-editor v-model="post_introduction"></app-wp-editor>
                        </el-tab-pane>

                        <el-tab-pane label="Ingredients">
                            <app-wp-editor v-model="post_ingredient"></app-wp-editor>
                        </el-tab-pane>

                        <el-tab-pane label="Description">
                            <app-wp-editor v-model="post_description"></app-wp-editor>
                        </el-tab-pane>

                        <el-tab-pane label="Nutrition">
                            <app-nutrition
                                v-for="(field, i) of nutritions" :key="i" :field="field"></app-nutrition>
                        </el-tab-pane>

                        <el-tab-pane label="Featured Image">
                            <div class="featured_image_section">
                                <img :src=featImage alt="" class="feat_img"><br>
                                <div class="feat_img_btn">
                                    <span class="upld_btn">
                                        <el-button @click="upload_image" v-if="!featImage">Upload Image</el-button>
                                    </span>
                                    <span class="img_custom_btn">
                                        <el-button @click="upload_image" v-if="featImage">Change Image</el-button>
                                        <el-button @click="featImage = '';" v-if="featImage">Remove</el-button>
                                    </span>
                                </div>
                            </div>
                        </el-tab-pane>

                    </el-tabs>
                </div>

                <div class="all_fields" v-if="recipe_type === 'advance'">
                    <el-tabs type="border-card" :stretch=stretch>

                        <el-tab-pane label="Introduction">
                            <app-wp-editor v-model="post_introduction"></app-wp-editor>
                        </el-tab-pane>

                        <el-tab-pane label="Ingredients">
                            <el-row :gutter="10">
                                <el-col :span="8" style="padding-left: 54px;">
                                    <label>Ingredient</label>
                                </el-col>
                                <el-col :span="8">
                                    <label>Amount</label>
                                </el-col>
                                <el-col :span="8">
                                    <label>Unit</label>
                                </el-col>
                            </el-row>
                            <draggable v-model="ingredients_data" @start="drag=true" @end="drag=false">
            
                                <el-row :gutter="10" v-for="(ingredient_data, i) in ingredients_data" :key="i">

                                    <el-col :span="1">
                                        <el-button size="small">D</el-button>
                                    </el-col>
                                    <el-col :span="7">
                                        <div>
                                            <el-input type="text" placeholder="Ingredients" v-model="ingredient_data.ingredient"></el-input>
                                        </div>
                                    </el-col>

                                    <el-col :span="8">
                                        <div>
                                            <app-input-number
                                                v-model="ingredient_data.amount"
                                                pcHolder="Amount"></app-input-number>
                                        </div>
                                    </el-col>
                                    
                                    <el-col :span="7">
                                        <div>
                                            <el-select v-model="ingredient_data.unit" placeholder="Unit" style="width: 100%;">
                                                <el-option 
                                                    v-for="(unit, i) in ingredients_unit"
                                                    :key="i"
                                                    :label="unit.label"
                                                    :value="unit.value"></el-option>
                                            </el-select>
                                        </div>
                                    </el-col>

                                    <el-col :span="1">
                                        <span style="cursor: pointer" @click="deleteIngField(i)">X</span>
                                    </el-col>
                                </el-row>
                            </draggable>
                            <el-button type="success" round size="medium" style="text-align: center" @click="addMoreIngField">+</el-button>
                        </el-tab-pane>

                        <el-tab-pane label="Description">
                            <draggable v-model="descriptions_adv" @start="drag=true" @end="drag=false">
                                <el-row :gutter="15" v-for="(description_adv, i) in descriptions_adv" :key="i">
                                    <el-col :span="1">
                                        <el-button size="small">D</el-button>
                                    </el-col>
                                    <el-col :span="15">
                                        <app-wp-editor v-model="description_adv.desc_text"></app-wp-editor>
                                    </el-col>
                                    <el-col :span="6">
                                        <img :src=description_adv.desc_img alt="" style="width: 50%;"><br>
                                        <div>
                                            <el-button @click="upload_img_adv_desc(i)" v-if="!description_adv.desc_img">Upload Image</el-button>
                                            <el-button @click="upload_img_adv_desc(i)" v-if="description_adv.desc_img">Change Image</el-button>
                                            <el-button @click="description_adv.desc_img = '';" v-if="description_adv.desc_img">Remove</el-button>
                                        </div>
                                    </el-col>
                                    <el-col :span="1">
                                        <span style="cursor: pointer; color: red;" @click="removeDescAdv(i)">X</span>
                                    </el-col>
                                </el-row>
                            </draggable>
                            <el-row>
                                <el-col>
                                    <el-button type="success" @click="addDescField" round>+</el-button>
                                </el-col>
                            </el-row>
                        </el-tab-pane>

                        <el-tab-pane label="Nutrition">
                            <app-nutrition
                                v-for="(field, i) in nutritions" :key="i" :field="field"></app-nutrition>
                        </el-tab-pane>
                        
                        <el-tab-pane label="Featured Image">
                            <div class="featured_image_section">
                                <img :src=featImage alt="" class="feat_img"><br>
                                <div class="feat_img_btn">
                                    <span class="upld_btn">
                                        <el-button @click="upload_image" v-if="!featImage">Upload Image</el-button>
                                    </span>
                                    <span class="img_custom_btn">
                                        <el-button @click="upload_image" v-if="featImage">Change Image</el-button>
                                        <el-button @click="featImage = '';" v-if="featImage">Remove</el-button>
                                    </span>
                                </div>
                            </div>
                        </el-tab-pane>

                    </el-tabs>
                </div>

            </el-col>

            <el-col class="show_preview">
                <h2>Optional Fields</h2>
                
                <el-row>
                    <el-col :span="24">
                        <label>Select Meal Type</label>
                        <el-select
                            v-model="selectedMealType"
                            multiple
                            filterable
                            allow-create
                            default-first-option
                            placeholder="Choose Meal Type"
                            style="width: 100%;">
                            <el-option
                                v-for="(item, i) in meal_types"
                                :key="i"
                                :label="item.label"
                                :value="item.value"></el-option>
                        </el-select>
                    </el-col>
                    <el-col :span="12">
                        <app-input-dropdown
                            v-model="selectedCusineType"
                            label="Select Cusine Type"
                            pcHolder="Select Cusine Type"
                            :recipeTypes="cusine_types"
                            styleObj="padding-right: 2px; width: 100%;"></app-input-dropdown>
                    </el-col>
                    <el-col :span="12">
                        <app-input-dropdown
                            v-model="selectedPreferenceType"
                            label="Select Preference Type"
                            pcHolder="Select Preference Type"
                            :recipeTypes="preference_types"
                            styleObj="padding-left: 2px; width: 100%;"></app-input-dropdown>
                    </el-col>
                    <el-col :span="24">
                        <app-input-number
                            v-model="totalPeople"
                            pcHolder="How many people serve?"
                            label="How many people serve?"></app-input-number>
                    </el-col>
                </el-row>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import wp_editor from './common/_wp_editor.vue'
import InputDropdown from './core/InputDropdown.vue'
import InputNumber from './core/InputNumber.vue'
import NutritionFields from './NutritionFields.vue'
import draggable from 'vuedraggable'
import Clipboard from 'clipboard'

export default {
    name: 'EditTable',
    components: {
        'app-wp-editor': wp_editor,
        'app-input-dropdown': InputDropdown,
        'app-input-number': InputNumber,
        'app-nutrition': NutritionFields,
        draggable
    },
    data() {
        return {
            table_id: this.$route.params.table_id,
            post_title: '',
            recipe_type: '',
            recipe_types: [
                { value: 'normal', label: 'Normal' },
                { value: 'advance', label: 'Advance' }
            ],
            meal_types: [
                { value: 'Breakfast', label: 'Breakfast' },
                { value: 'Lunch', label: 'Lunch' },
                { value: 'Dinner', label: 'Dinner' }
            ],
            cusine_types: [
                { value: 'Indian', label: 'Indian' },
                { value: 'Thai', label: 'Thai' },
                { value: 'Chinese', label: 'Chinese' }
            ],
            preference_types: [
                { value: 'Vegetable', label: 'Vegetable' },
                { value: 'Non-vegetable', label: 'Non-vegetable' }
            ],
            ingredients_data: [
                { ingredient: '', amount: '', unit: '' }
            ],
            ingredients_unit: [
                { value: 'TSP', label: 'TSP' },
                { value: 'Tbs', label: 'Tbs' },
                { value: 'Cup', label: 'Cup' },
                { value: 'Kg', label: 'Kg' },
                { value: 'Liter', label: 'Liter' }
            ],
            descriptions_adv: [
                { desc_text: '', desc_img: '' }
            ],
            nutritions: [
                [
                    { serial: 0, label: 'Calories', disabled: false, value: 0 },
                    { serial: 1, label: 'Calories From Fat', disabled: false, value: 0 },
                    { serial: 2, label: 'Total Fat', disabled: false, value: 0 },
                    { serial: 3, label: 'Saturated Fat', disabled: false, value: 0 },
                    { serial: 4, label: 'Trans Fat', disabled: false, value: 0 },
                    { serial: 5, label: 'Cholesterol', disabled: false, value: 0 },
                    { serial: 6, label: 'Sodium', disabled: false, value: 0 },
                    { serial: 7, label: 'Potassium', disabled: false, value: 0 },
                    { serial: 8, label: 'Total Carbohydrate', disabled: false, value: 0 },
                    { serial: 9, label: 'Dietary Fiber', disabled: false, value: 0 }
                ],
                [
                    { serial: 10, label: 'Sugars', disabled: false, value: 0 },
                    { serial: 11, label: 'Protein', disabled: false, value: 0 },
                    { serial: 12, label: 'VitaminA', disabled: false, value: 0 },
                    { serial: 13, label: 'VitaminC', disabled: false, value: 0 },
                    { serial: 14, label: 'VitaminD', disabled: false, value: 0 },
                    { serial: 15, label: 'VitaminE', disabled: false, value: 0 },
                    { serial: 16, label: 'VitaminK', disabled: false, value: 0 },
                    { serial: 17, label: 'VitaminB6', disabled: false, value: 0 },
                    { serial: 18, label: 'VitaminB12', disabled: false, value: 0 },
                    { serial: 19, label: 'Calcium', disabled: false, value: 0 }
                ],
                [
                    { serial: 20, label: 'Iron', disabled: false, value: 0 },
                    { serial: 21, label: 'Thiamin', disabled: false, value: 0 },
                    { serial: 22, label: 'Riboflavin', disabled: false, value: 0 },
                    { serial: 23, label: 'Niacin', disabled: false, value: 0 },
                    { serial: 24, label: 'Folate', disabled: false, value: 0 },
                    { serial: 25, label: 'Biotin', disabled: false, value: 0 },
                    { serial: 26, label: 'Pantothenic Acid', disabled: false, value: 0 },
                    { serial: 27, label: 'Phosphorus', disabled: false, value: 0 },
                    { serial: 28, label: 'Iodine', disabled: false, value: 0 },
                    { serial: 29, label: 'Magnesium', disabled: false, value: 0 }
                ],
                [
                    { serial: 30, label: 'Zinc', disabled: false, value: 0 },
                    { serial: 31, label: 'Selenium', disabled: false, value: 0 },
                    { serial: 32, label: 'Copper', disabled: false, value: 0 },
                    { serial: 33, label: 'Manganese', disabled: false, value: 0 },
                    { serial: 34, label: 'Chromium', disabled: false, value: 0 },
                    { serial: 35, label: 'Molybdenum', disabled: false, value: 0 },
                    { serial: 36, label: 'Chloride', disabled: false, value: 0 },
                    { serial: 37, label: '', disabled: false, value: 0},
                    { serial: 38, label: '', disabled: false, value: 0},
                    { serial: 39, label: '', disabled: false, value: 0}
                ]
            ],
            stretch: true,
            upload_img: '',
            post_ingredient: '',
            post_description: '',
            post_introduction: '',
            post_nutrition: '',
            post_nutrition_adv: '',
            selectedMealType: [],
            selectedCusineType: '',
            selectedPreferenceType: '',
            featImage: '',
            totalPeople: '',
            demo_url: ''
        }
    },
    created() {
        this.fetchTable();
        this.clipboardRender();
    },
    methods: {
        fetchTable() {

            jQuery.get(ajaxurl, {
                action: 'ninja_recipe_ajax_actions',
                route: 'get_table',
                table_id: this.table_id
            })
            .then(
                (response) => {
                    console.log(response)
                    this.post_title = response.data.table.post_title;
                    this.recipe_type = response.data.table.recipe_type;
                    this.demo_url = response.data.demo_url;
                    if( response.data.tableConfig ) {

                        if( this.recipe_type == 'normal' ) {

                            this.post_introduction = response.data.tableConfig.introduction;
                            this.post_description = response.data.tableConfig.description;
                            this.nutritions = response.data.tableConfig.nutrition;
                            this.post_ingredient = response.data.tableConfig.ingredient;

                        }

                        else if( this.recipe_type == 'advance' ) {

                            this.post_introduction = response.data.tableConfig.introduction;
                            this.descriptions_adv = response.data.tableConfig.description;
                            this.nutritions = response.data.tableConfig.nutrition;
                            this.ingredients_data = response.data.tableConfig.ingredient;

                        }
                    
                        this.selectedMealType = response.data.tableConfig.mealType;
                        this.selectedCusineType = response.data.tableConfig.cusineType;
                        this.selectedPreferenceType = response.data.tableConfig.preferenceType;
                        this.totalPeople = response.data.tableConfig.totalPeople;
                        this.featImage = response.data.tableConfig.featuredImage;
                    }
                }
            )

        },
        updateTableConfig() {

            if( this.recipe_type === 'normal' ) {
                var introduction = this.post_introduction;
                var ingredient = this.post_ingredient;
                var description = this.post_description;
                var nutrition = this.nutritions;
            }

            else if( this.recipe_type === 'advance' ) {
                var introduction = this.post_introduction;
                var ingredient = this.ingredients_data;
                var description = this.descriptions_adv;
                var nutrition = this.nutritions;
            }

            var featImage = this.featImage;

            let tableConfig = {
                introduction: introduction,
                ingredient: ingredient,
                description: description,
                nutrition: nutrition,
                mealType: this.selectedMealType,
                cusineType: this.selectedCusineType,
                preferenceType: this.selectedPreferenceType,
                totalPeople: this.totalPeople,
                featuredImage: featImage
            };

            console.log(tableConfig)

            jQuery.post(ajaxurl, {
                action: 'ninja_recipe_ajax_actions',
                route: 'update_table',
                table_id: this.table_id,
                table_config: JSON.stringify(tableConfig),
                recipe_type: this.recipe_type
            })
            .then(
                (response) => {
                    this.$notify.success({
                        title: 'Updated',
                        message: response.data.message
					});
                }
            )
        },

        upload_image() {
            var button = $(this);
            var custom_uploader = wp.media({

                title: 'Insert Recipe Image',
                library : {
                    type : 'image'
                },
                button: {
                    text: 'Use this image' 
                },
                multiple: false

            }).on('select', () => { // using the arrow function cause there is a callback(.on) inside function 
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.id).next().show();
                this.featImage = attachment.url;
                console.log('Featured Image is: ' + this.featImage)
            })
            .open();
        },

        upload_img_adv_desc(i) {
            var button = $(this);
            var custom_uploader = wp.media({

                title: 'Insert Description Image',
                library : {
                    type : 'image'
                },
                button: {
                    text: 'Use this image' 
                },
                multiple: false

            }).on('select', () => { // using the arrow function cause there is a callback(.on) inside function 
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.id).next().show();
                this.descriptions_adv[i].desc_img = attachment.url;
            })
            .open();
        },

        addMoreIngField() {
            this.ingredients_data.push({
                ingredient: '',
                amount: '',
                unit: ''
            })
        },

        deleteIngField(index) {
            this.ingredients_data.splice(index, 1);
        },

        addDescField() {
            this.descriptions_adv.push({
                desc_text: '',
                desc_img: ''
            })
        },

        removeDescAdv(index) {
            this.descriptions_adv.splice(index, 1);
        },

        clipboardRender() {
            var clipboard = new Clipboard('.copy');
            clipboard.on('success', (e) => {
                this.$message({
                    message: 'Copied to Clipboard!',
                    type: 'success'
                });
            });
        },

    },
    watch: {
        upload_img() {
            console.log(this.upload_img)
        }
    }
}
</script>

<style lang="scss">
.ninja_recipe_table {

    .header {
        font-size: 20px;
	    padding-bottom: 10px;
	    background: #fff;
	    margin-top: -20px;
	    padding-top: 22px;
	    margin-right: -20px;
	    margin-left: -20px;
	    padding-left: 24px;
    }

    .table_action_btn {
        padding-left: 93px;
    }

    .fields {
        width: 68%;
		background: #fff;
		margin-top: 15px;
		margin-right: 20px;
		padding: 20px;
        h2 {
            margin-top: 0;
        }
        .all_fields {
            margin-top: 30px;
            .featured_image_section {
                .feat_img {
                    width: 50%;
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                }
                .feat_img_btn {
                    .upld_btn {
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                        width: 12%;
                    }
                    .img_custom_btn {
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                        width: 30%;
                    }
                }
            }
        }
	}

    .show_preview {
        width: 29.6%;
        background: #fff;
		margin-top: 15px;
		margin-right: 20px;
		padding: 20px;
        h2 {
            margin-top: 0;
        }
    }

    .change_type {
		float: right;
	  	margin-top: -36px;
	}

    .el-message--success {
        z-index: 999999!important;
        top: 5px;
    }

    .el-input__inner {
        background: #fff;
    }
}
</style>
