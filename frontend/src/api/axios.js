import axios from 'axios'
import URL from './URL'

let instance = axios.create({
    baseURL: URL,
    withCredentials: true
})

instance.interceptors.request.use(request => {
    request.headers.common['Accept'] = 'application/json';
    request.headers.common['Content-Type'] = 'application/json';
    return request;
})

instance.interceptors.response.use(
    response => { return response; },
    error => {
        if(error.response.status === 401){
            localStorage.removeItem('user');
            localStorage.removeItem('token');
        }
        return Promise.reject(error);
    }
);

export default instance;