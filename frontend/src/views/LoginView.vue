<template>
    <div class="login_body">
        <div class="login_container">
            <div class="login_container_inside">
                <h1>Logowanie</h1>
                <hr class="login_hr" />
                <form @submit.prevent="Login">
                    <input type="email" placeholder="Email" class="input_login" v-model="user.email" />
                    <input type="password" placeholder="Password" class="input_login" v-model="user.password" />
                    <div class="login_button_container">
                        <button type="submit" class="login_button">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</template>

<script>

export default {
    name: "LoginView",
    data(){
        return{
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods:{
        async Login(){
            //alert(this.email + " " + this.password);
            try{
                await this.$store.dispatch('login', this.user);
                await this.$router.push({name: 'Home'});
            }catch(error){
                console.log(error)
            }
            
        }
    }
}
</script>

<style scoped>
.login_body{
    min-height: 100vh;
    width: 100%;
    background-image: linear-gradient(rgba(7,7,7,.7),hsla(0,0%,82%,.1)),url(../assets/Images/background.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 50%;
    display: flex;
}
.login_container{
    width: 90%;
    margin: auto;
    max-width: 500px;
    background: hsla(0,0%,100%,.6);
    padding: 50px 5px 50px 5px;
    border-radius: 20px;
    border: 5px solid #254455;
    display: flex;
}
.login_container_inside{
    width: 100%;
    position: relative;
    margin: auto;
    padding: 30px 5px;
}
.login_hr{
    width: 60%;
    max-width: 300px;
    border: 1px solid #2b2b2b;
    background-color: #2b2b2b;
    margin: 20px auto 40px auto;
}
.input_login{
    width: 80%;
    max-width: 300px;
    height: 25px;
    border: none;
    border-radius: 6px;
    padding: 5px;
    margin-bottom: 20px;
    background: hsla(0,0%,100%,.8);
    transition: .3s;
    transition: .5s;
}
.input_login:focus{
    border: none;
    outline: none;
    transform: scale(1.03);
}
.login_button{
    width: 80%;
    max-width: 315px;
    height: 40px;
    margin-top: 15px;
    background: #254455;
    border: none;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
}
</style>