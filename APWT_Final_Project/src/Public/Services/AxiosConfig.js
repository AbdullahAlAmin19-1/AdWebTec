import axios from 'axios';
const instance = axios.create({
    baseURL : 'http://localhost:8000/api/'
});

instance.interceptors.request.use((config)=>{
    config.headers.common["Authorization"] = localStorage.getItem('_authToken');
    config.headers.common["user_type"] = localStorage.getItem('user_type');
    config.headers.common["user_id"] = localStorage.getItem('user_id');
    config.headers.common["product_id"] = localStorage.getItem('product_id');
    return config;
},(err)=>{});

instance.interceptors.response.use((rsp)=>{
    return rsp;
},(err)=>{
    if(err.response.status == 401){
        window.location.href="/login";
    }
    return Promise.reject(err);
});
export default instance;