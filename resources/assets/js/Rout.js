/**
 * Created by emad_ on 7/28/2018.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from './components/Login.vue'
import LogOut from './components/Logout.vue'
import Content from './components/Content.vue'
import Supporters from './components/Supporters.vue'
import Details from './components/Details.vue'
import Sidebar from './components/Admin/Sidebar.vue'
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import CarsTable from './components/Admin/CarsTable.vue'
import RentedTable from './components/Admin/RentedTable.vue'
import CategoriesTable from './components/Admin/CategoryTable.vue'
import AddCar from './components/Admin/AddCar.vue'
import AddCategory from './components/Admin/AddCategory.vue'
import Chart from './components/Admin/Chart.vue'

Vue.use(VueRouter)
const router =new VueRouter({
    routes:[
        {
            path:'/login',
            components:{
                Content:Login
            }
        },
        {
            path:'',
            components:{
                Content:Login
            }
        },
        {
            path:'/home',
            name:'home',
            components:{
                Nav:Navbar,
                Content:Content,
            }
        },
        {
            path:'/support',
            components:{
                Nav:Navbar,
                Content:Supporters,
            }
        },
        {
            path:'/details',
            name:'detailsName',
            components:{
                Nav:Navbar,
                Content:Details,

            },
            props:true
        },
        {
            path:'/dashboard',
            name:'dash',
            components:{
                Nav:Navbar,
                Sidebar:Sidebar,
            },
            children:[
                {
                    path: "carsTable",
                    name: "CarsTable",
                    component: CarsTable
                },
                {
                    path: "categoriesTable",
                    name: "CategoriesTable",
                    component: CategoriesTable
                },
                {
                    path: "rentedCars",
                    name: "RentedCars",
                    component: RentedTable
                },
                {
                    path: "addCar",
                    name: "AddCar",
                    component: AddCar
                },
                {
                    path: "addCategory",
                    name: "AddCategory",
                    component: AddCategory
                },
                {
                    path: '',
                    name: "Chart",
                    component: Chart
                },
            ],


        },

        {
            path:'/logout',
            components:{
                Content:LogOut
            }
        },


    ]
})
export default router