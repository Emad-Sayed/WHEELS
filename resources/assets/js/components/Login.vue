
<template>
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->


    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                </div>

                <div style="padding-top:30px" class="panel-body" >

                    <div v-bind:class="{ ' alert alert-danger':ErrorMessage} ">{{ErrorMessage}}</div>
                    <form id="loginform" class="form-horizontal" role="form">

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input v-model="loginInfo.email" type="text" class="form-control" name="username"  placeholder="Enter email">
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input v-model="loginInfo.password" type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>



                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                </label>
                            </div>
                        </div>


                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <button type="button" @click="checkLogin" href="#" class="btn btn-success">Login  </button>

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    Don't have an account!
                                    <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                        Sign Up Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign Up</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                </div>
                <div class="panel-body" >
                    <form id="signupform" class="form-horizontal" role="form">

                        <div v-if="registError"  class="alert alert-danger">
                            <p>{{registErrorMessage}}</p>
                            <span></span>
                        </div>



                        <div class="form-group">
                            <label  class="col-md-3 control-label">Full Name</label>
                            <div class="col-md-9">
                                <input v-model="registInfo.name" type="text" class="form-control" placeholder="Full Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input v-model="registInfo.email" type="text" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input v-model="registInfo.password" type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm Password</label>
                            <div class="col-md-9">
                                <input v-model="registInfo.c_password" type="password" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>






                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-md-offset-3 col-md-9">
                                <button @click="regist" id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                            </div>
                        </div>




                    </form>
                </div>
            </div>




        </div>
    </div>

</template>
<script>
    import {apiDomain,loginURL,registURL,userURL,GetHeaders,isSet} from '../config'
    export default{
        data(){
            return {
               loginInfo:{
                   email:'',
                   password:''
               },
                registInfo:{
                   name:'',
                   email:'',
                    password:'',
                    c_password:''
                },
                loginError:false,
                ErrorMessage:'',
                registError:false,
                registErrorMessage:''
            }
        },
        created(){
            if((isSet()))
                this.$router.push('/');
        },
        methods:{
            checkLogin(){
                axios.post(loginURL, this.loginInfo)
                    .then(response => {
                        if (response.status === 200) {
                            window.localStorage.setItem('token', response.data.success.token)
                            axios.post('api/details',{data:{}},{headers:GetHeaders()} )
                                .then(response=>{
                                    window.localStorage.setItem('user', JSON.stringify(response.data.success))
                                    this.$router.push('/');
                                })
                        }
                    })
                    .catch(err=>{
                        this.loginError=true;
                        this.ErrorMessage='Incorrect Email or Password';
                    })
            },
            regist(){
             axios.post(registURL,this.registInfo)
                 .then(response=>{
                     window.localStorage.setItem('token', response.data.success.token)
                     axios.post('api/details',{data:{}},{headers:GetHeaders()} )
                         .then(response=>{
                             window.localStorage.setItem('user', JSON.stringify(response.data.success))
                             this.$router.push('/');
                         })
                 })
                 .catch(err=>{
                     this.registError=true
                     this.registErrorMessage=err.response.data.error
                 })
            }
        },
    }
</script>
