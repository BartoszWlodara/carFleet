<template>
    <div class="from_wrapper">
        <div class="container">
            <div class="container_header">Dodawanie nowego pojazdu
                <hr class="container_header_hr" />
            </div>
            <form @submit.prevent="AddCar">
                <div class="form">
                    <div class="input_form">
                        <label class="input_form_label" >Marka</label>
                        <input  v-model="car.CarMake" type="text" />
                    </div>
                    <div class="input_form">
                        <label class="input_form_label" >Model</label>
                        <input required v-model="car.Model" type="text" />
                    </div>
                    <div class="input_form">
                        <label class="input_form_label" >Rok produkcji</label>
                        <input required v-model="car.Year" type="number" />
                    </div>
                    <div class="input_form">
                        <label class="input_form_label" >Nr rejestracyjny</label>
                        <input required v-model="car.CarPlate" type="text" />
                    </div>                   
                    <div class="input_form">
                        <label class="input_form_label" >Przegląd do</label>
                        <input required v-model="car.CarReviewDateTo" type="date" placeholder="data" class="date_input" />
                    </div>  
                    <div class="input_form">
                        <label class="input_form_label" >Ubezpieczenie do</label>
                        <input required v-model="car.InsuranceTo" type="date" />
                    </div>  
                    <div class="input_form">
                        <label class="input_form_label" >Data ostatniej wymiany oleju</label>
                        <input required v-model="car.OilChangeDate" type="date" />
                    </div>  
                    <div class="input_form">
                        <label class="input_form_label" >Przebieg</label>
                        <input required v-model="car.Milage" type="number" />
                    </div>                     
                </div>
                <div v-for="(item, index) in error[0]" :key="index"  class="error_message">
                     {{item[0]}}
                </div>
                <div class="container_buttons">
                    <hr class="container_header_hr" />
                    <button type="submit" class="button_send">Dodaj</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import API from '../api/repository'

export default {
    name: 'CarFormComponent',
    data(){
        return{
            car:{
                CarMake: '',
                Model: '',
                Year: null,
                CarPlate: '',
                CarReviewDateTo: null,
                InsuranceTo: null,
                OilChangeDate: null,
                Milage: null
            },
            error: []
        }
    },
    methods:{
        async AddCar(){
            for(let prop in this.car) {
                if(this.car[prop] === '' || this.car[prop] === null){
                    return this.error.push('Pole "'+prop+'" nie zostało wypełnione.');
                }else{
                    this.error = [];
                }             
            }

            if(this.error.length === 0){
                try{
                    await API.addCar(this.car).then(()=>{
                        this.$router.push({name: 'CarListView'});
                    });
                }catch(error){
                    this.error.push(error.response.data.errors);
                }
            }
        }
    }
}
</script>

<style scoped>
.container{
    width: 90%;
    margin: 30px auto;
    max-width: 1300px;
    padding: 20px 5px 20px 5px;
}
.container_header{
    text-align: left;
    font-size: 18px;
    font-weight: 600;
}
.container_header_hr{
    margin-top: 10px;
}
.form{
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin-top: 25px;
}
.input_form{
    width: calc(90% - 20px);
    max-width: 400px;
    margin: 10px;
}
@media(min-width:1400px){
    .form::after {
    content: "";
    width: calc(33% - 5px);
    }
}
.input_form > input{
    width: 100%;
    height: 25px;
    border: none;
    border-radius: 6px;
    padding: 5px;
    background: hsla(0,0%,100%,.8);
    margin-top: 20px;
}
.input_form > input:focus{
    outline: none;
}
.input_form_label{
    position: absolute;
    font-size: 12px;
    font-weight: 600;
}
.date_input{
    cursor: pointer;
}
.container_buttons{
    margin-top: 40px;
}
.button_send{
    height: 40px;
    width: 200px;
    border-radius: 7px;
    border: none;
    background-color: #455457;
    color: #FFFFFF;
    font-weight: 600;
    margin-top: 20px;
    cursor: pointer;
    transition: .3s;
}
.button_send:hover{
    transform: scale(1.1);
    background: #e7e7e7;
    color:rgb(80, 80, 80);
}
.error_message{
    margin-top: 20px;
    color: #ac2525;
    text-shadow: 0 0 8px #000000;
    font-weight: 600;
}
</style>