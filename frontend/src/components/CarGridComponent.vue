<template>
    <div id="car_grid" v-bind:class="{'left_align': leftLastElement}">
        <div v-for="(car, index) in CarList" :key="car.id" class="grid_record">
            <div class="grid_column_count">{{index+1}}</div>
            <div class="grid_column">{{car.CarMake}}
                <label class="grid_column_label">Marka</label>
            </div>
            <div class="grid_column">{{car.Model}}
                <label class="grid_column_label">Model</label>
            </div>
            <div class="grid_column">{{car.Year}}
                <label class="grid_column_label">Rok prod.</label>
            </div>
            <div class="grid_column">{{car.CarPlate}}
                <label class="grid_column_label">Nr Rejestracyjny</label>
            </div>
            <div class="grid_column">{{car.CarReviewDateTo}}
                <label class="grid_column_label">Następny przegląd</label>
            </div>
            <div class="grid_column">{{car.InsuranceTo}}
                <label class="grid_column_label">OC do</label>
            </div>
            <div class="grid_column">{{car.OilChangeDate}}
                <label class="grid_column_label">Poprzednia wym. oleju</label>
            </div>
            <div class="grid_column actions">
                <router-link tag="div" :to='"updateCar/"+car.id' class="grid_column_action_button">
                    <EditIcon size="1.35x" class="carList_icons" />
                </router-link>
                <div @click="ShowDeleteModal(car.id)" class="grid_column_action_button red">
                    <Trash2Icon size="1.35x" class="carList_icons" />
                </div>
            </div>
        </div>
        <transition name="fade">
            <DeleteModal v-if="showDeleteModal" @close="CloseDeleteModal" @delete="DeleteCarElement"/>
        </transition>
    </div>
</template>
<script>
import {EditIcon, Trash2Icon} from '../assets/Icons'
import API from '../api/repository'
import DeleteModal from './Modals/DeleteModal.vue'

export default {
    name: 'CarGrid',
    components:{
        EditIcon,
        Trash2Icon,
        DeleteModal
    },
    data(){
        return{
            CarList: [],
            leftLastElement: false,
            carToDelete: null,
            showDeleteModal: false
        }
    },
    methods:{
        ShowDeleteModal(id){
            this.carToDelete = id;
            this.showDeleteModal = true;
        },
        CloseDeleteModal(){
            this.carToDelete = null;
            this.showDeleteModal = false;
        },
        async DeleteCarElement(){
            try{
                await API.deleteCar(this.carToDelete).then(()=>{
                    this.$router.go();
                });
            }catch(error){
                console.log(error);
                this.CloseDeleteModal();
            }
        },
        UpdateElement(){
         
        },
        async LoadCarList(){
            try{
                await API.getCars().then((response)=>{
                    this.CarList = response.data; 
                });
            }catch(error){
                console.log(error);
            }finally{
                this.CheckHeightOfGrid();
            }
        },
        CheckHeightOfGrid(){
            let height = document.getElementById('car_grid').offsetHeight;

            if(height > 900){
                this.leftLastElement = true;
            }else{
                this.leftLastElement = false;
            }
        }
    },
    mounted(){
        this.LoadCarList();
    },
    created() {
        window.addEventListener("resize", this.CheckHeightOfGrid);
    },
    destroyed() {
        window.removeEventListener("resize", this.CheckHeightOfGrid);
    }
}
</script>
<style scoped>
#car_grid{
    width: 90%;
    margin: 30px auto;
    max-width: 1500px;
    padding: 20px 5px 20px 5px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.left_align::after {
  content: "";
  flex: auto;
}
.grid_record{
    width: calc(25% - 60px);
    min-height: 50px;
    display: -webkit-box;
    flex-wrap: wrap;
    box-shadow: 0 2px 8px #161616;
    padding: 10px;
    border-radius: 5px;
    margin: 20px 20px 30px 20px;
    position: relative;
    background: #353535;
}
@media(max-width:1350px){
    .grid_record{
        width: calc(25% - 40px);
        margin: 20px 10px 30px 10px;
    }
}
@media(max-width:1220px){
    .grid_record{
        width: calc(33% - 37px);
        margin: 20px 10px 30px 10px;
    }
}
@media(max-width:1015px){
    .grid_record{
        width: calc(50% - 40px);
        margin: 20px 10px 30px 10px;
    }
}
@media(max-width:700px){
    .grid_record{
        width: calc(100% - 20px);
        margin: 20px 10px 30px 10px;
    }
}
.grid_column_count, .grid_column{
    margin: 5px 2% .5% .2%;
    height: 50px;
}
.grid_column_count{
    width: 50px;
    border-radius: 50%;
    background: #455457;
    color: #fff;
    line-height: 50px;
    font-weight: 700;
    position: absolute;
    top: -30px;
    left: -10px;
    z-index: 0;
}
.grid_column{
    min-width: 100px;
    position: relative;
    background: #424242;
    padding-bottom: 7px;
    border-radius: 5px;
    font-size: 14.5px;
    font-weight: 600;
    color: #cfcfcf;
    width: 100%;
    line-height: 60px;
}
.grid_column_label{
    position: absolute;
    top: 8px;
    left: 5px;
    transform: translateY(-50%);
    font-size: 11px;
    line-height: 10px;
    text-align: left;
    font-weight: 500;
    color: #fff;
}
.actions{
    display: flex;
    justify-content: center;
}
.grid_column_action_button{
    border-radius: 50%;
    background: #3d4b50;
    margin: 8px 3% auto 3%;
    height: 40px;
    width: 40px;
    box-shadow: 0 0 4px #2b2b2b;
}
.red{
    background: #581313;
}
.carList_icons{
    padding-bottom: 6px;
    cursor: pointer;
    color: #fff;
    transition: .2s;
}
.carList_icons:hover{
    transform: scale(1.1);
}
</style>