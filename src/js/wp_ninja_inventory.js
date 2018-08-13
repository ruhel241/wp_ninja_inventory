import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './router.js'

import locale from 'element-ui/lib/locale';
import lang from 'element-ui/lib/locale/lang/en';
locale.use(lang);

// importing the reqired components 
import {
	Row,
	Col,
	Input,
	Button,
	Table,
	Dialog,
	TableColumn,
	RouterLink


} from 'element-ui'



// making the requied components global 
Vue.use(Row)
Vue.use(Col)
Vue.use(Button)
Vue.use(Input)
Vue.use(Table)
Vue.use(Dialog)
Vue.use(TableColumn)
Vue.use(VueRouter)



//importing css of required components 
import 'element-ui/lib/theme-chalk/index.css';
import 'element-ui/lib/theme-chalk/row.css';
import 'element-ui/lib/theme-chalk/input.css';
import 'element-ui/lib/theme-chalk/button.css';
import 'element-ui/lib/theme-chalk/dialog.css';
import 'element-ui/lib/theme-chalk/table.css';
import 'element-ui/lib/theme-chalk/table-column.css';


//importing the root component 
import App from './AdminApp';

const router  = new VueRouter({
	routes
})



new Vue({
	el: "#wp_ninja_inventory",
	router,
	render: h => h(App)
})

