<template></template>
<script>
    export default{
        data()
        {
            return {count:0};
        },
        created()
        {
            this.logOut();
        },
        methods:{
            logOut(){
                window.localStorage.removeItem('token')
                window.localStorage.removeItem('user')
                this.$router.push('/login')
            }
        }
    }
</script>