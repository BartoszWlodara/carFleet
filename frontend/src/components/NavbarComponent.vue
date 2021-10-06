<template>
    <div>
        <div class="margin_belt"></div>
        <div class="nav">
            <div class="logo">
                <router-link to='/'>
                    <img src="../assets/Images/logo.png" />
                </router-link>
            </div>
            <div v-if="authenticated" @click="Logout" class="auth_button">
                <PowerIcon size="1.6x" class="logout_icon"></PowerIcon>
            </div>
        </div>
    </div>

</template>
<script>
import {PowerIcon} from '../assets/Icons'
import {mapGetters} from 'vuex' 

export default {
    name: 'Navbar',
    components:{
        PowerIcon
    },
    methods:{
        async Logout(){
            try{
                await this.$store.dispatch('logout');
                await this.$router.push({name: 'Login'});
            }catch(error){
                console.log(error)
            }
        }
    },
    computed: {
      ...mapGetters([
          'authenticated'
      ])
    }
}
</script>
<style scoped>
.margin_belt{
    height: 70px;
}
.nav{
    height: 70px;
    box-shadow: 0 2px 8px rgb(31 31 31);
    padding: 0;
    display: flex;
    justify-content: center;
    position: fixed;
    width: 100vw;
    z-index: 10;
    top: 0;
    background: #383838;
}
.logo{
    height: 60px;
    width: 120px;
    margin-top: 5px;
}
.logo > a > img{
    width: 100%;
    border-radius: 20px;
}
.auth_button{
    height: 40px;
    width: 40px;
    border-radius: 50%;
    border: 2px solid #b7b7b7;
    cursor: pointer;
    margin: 13px 25px auto auto;
    font-size: 12px;
    font-weight: 600;
    line-height: 35px;
    position: absolute;
    right: 0;
    background: #585858;
    display: flex;
    transition: .3s;
}
.logout_icon{
    color: #d3d3d3;
    margin: auto;
    stroke-width: 3px;
}
.auth_button:hover{
    transform: scale(1.1);
}
</style>