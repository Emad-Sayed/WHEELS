<template>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/#/">WHEELS</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="/#/">Home <span class="sr-only">(current)</span></a></li>
                            <li><a href="/#/support">Supporters <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">Favourits</a></li>
                        </ul>
                        <ul  class="nav navbar-nav navbar-right">
                            <li >
                                <ul class="nav navbar-nav navbar-right">
                                    <li v-if="!isLogged"><a href="/#/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                                </ul>
                            </li>

                            <li v-if="isLogged" class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a id="UserName" href="#">Name :: <b>{{user.name}}</b> <br></br>Balance  ::  <b>{{user.userBalance}}</b></a></li>
                                    <li role="separator" class="divider"></li>
                                    <li id="Profile" ><a href="/Profile">Profile</a></li>
                                    <li v-if="user.type_id==1" ><a href="/#/dashboard">Dashboard</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/#/LogOut">LogOut</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>




            <!--Routings !-->
            <div >
                <router-view></router-view>

                </div>
            </div>

        <!--Footer !-->
        <Footer></Footer>

        </div>
</template>

<script>
    import {isSet} from '../config'
    import Footer from '../components/Footer.vue'
    export default{
        data(){
            return {
                isLogged:false,
                user:{},
            };
        },
        components:{
          'Footer':Footer
        },

        created(){
            if(this.$route.params.LoginFlag){
                this.isLogged=true
            }
                let temp=JSON.parse(window.localStorage.getItem('user'))
            if(temp!=null){
                this.user=temp
                console.log(this.user)
                this.isLogged=true
            }
            else {

            }

        },
        methods:{

        }
    }
</script>