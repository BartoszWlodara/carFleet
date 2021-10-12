<template>
    <div class="modal_backdrop">
        <div class="delete_modal">
            <div @click="closeModal" class="close_modal">
                <XIcon size="1.4x" class="close_icon" />
            </div>
            <div class="delete_info">
                <h2>Czy na pewno chcesz usunąć?</h2>
            </div>
            <div class="row">
                <button @click="closeModal" class="delete_button">Anuluj</button>
                <button @click="deleteElement" class="delete_button red_btn">Usuń</button>
            </div>
        </div>
    </div>
</template>
<script>
import { XIcon } from '@/assets/Icons'
export default {
    name: 'DeleteModal',
    components:{
        XIcon
    },
    methods:{
        closeModal(){
            this.$emit('close');
        },
        deleteElement(){
            this.$emit('delete');
        }
    }
}
</script>
<style scoped>
.modal_backdrop{
    width: calc(100vw - 18px);
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 10;
    display: flex;
}
.delete_modal{
    margin: auto;
    width: calc(90% - 40px);
    max-width: 500px;
    padding: 20px;
    background-color: #434343;
    border-radius: 10px;
    box-shadow: 0 2px 4px 0px #232323;
    position: relative;
}
.delete_info > h2{
    font-size: 16px;
    padding: 0 30px;
}
.delete_button{
    padding: 8px 10px;
    width: 100px;
    margin: 10px;
    border-radius: 5px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: .2s;
    color: #4f4f4f;
}
.delete_button:hover{
    transform: scale(1.06);
}
.close_modal{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ffffff;
    position: absolute;
    right: -10px;
    top: -20px;
    cursor: pointer;
    transition: .2s;
}
.close_modal:hover{
    transform: scale(1.1);
}
.close_icon{
    color: #393939;
    padding-top: 9px;
    stroke-width: 3px;
}
</style>