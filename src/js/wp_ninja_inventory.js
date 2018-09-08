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
	RouterLink,
	Container,
	Aside,
	Header,
	Main,
	Footer,
	Menu,
	Submenu,
	MenuItem,
	MenuItemGroup,
	Checkbox,
	Option,
	Select,
	Message,
	Notification

} from 'element-ui'



// making the requied components global 
Vue.use(Row)
Vue.use(Col)
Vue.use(Button)
Vue.use(Input)
Vue.use(Checkbox)
Vue.use(Option)
Vue.use(Select)
Vue.use(Table)
Vue.use(Dialog)
Vue.use(TableColumn)
Vue.use(VueRouter)
Vue.use(Container)
Vue.use(Aside)
Vue.use(Header)
Vue.use(Main)
Vue.use(Footer)
Vue.use(Menu)
Vue.use(Submenu)
Vue.use(MenuItem)
Vue.use(MenuItemGroup)



//importing css of required components 
import 'element-ui/lib/theme-chalk/index.css';

import 'element-ui/lib/theme-chalk/container.css';
import 'element-ui/lib/theme-chalk/aside.css';
import 'element-ui/lib/theme-chalk/header.css';
import 'element-ui/lib/theme-chalk/main.css';
import 'element-ui/lib/theme-chalk/footer.css';
import 'element-ui/lib/theme-chalk/menu.css';
import 'element-ui/lib/theme-chalk/submenu.css';
import 'element-ui/lib/theme-chalk/submenu.css';
import 'element-ui/lib/theme-chalk/menu-item.css';
import 'element-ui/lib/theme-chalk/menu-item-group.css';
import 'element-ui/lib/theme-chalk/row.css';
import 'element-ui/lib/theme-chalk/input.css';
import 'element-ui/lib/theme-chalk/checkbox.css';
import 'element-ui/lib/theme-chalk/option.css';
import 'element-ui/lib/theme-chalk/select.css';
import 'element-ui/lib/theme-chalk/button.css';
import 'element-ui/lib/theme-chalk/dialog.css';
import 'element-ui/lib/theme-chalk/table.css';
import 'element-ui/lib/theme-chalk/table-column.css';
import 'element-ui/lib/theme-chalk/notification.css';
Vue.prototype.$notify = Notification;
Vue.prototype.$message = Message;

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

