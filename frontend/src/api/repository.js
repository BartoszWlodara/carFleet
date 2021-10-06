import api from './axios'

export default {
    createSession(){
        return api.get('sanctum/csrf-cookie');
    },
    login(param){
        return api.post('api/login', param);
    },
    logout(){
        return api.delete('api/logout');
    },
    getCars(){
        return api.get('api/cars', {
            headers:{
                'Authorization': localStorage.token? 'Bearer ' + localStorage.token : null
            }
        })
    }
}