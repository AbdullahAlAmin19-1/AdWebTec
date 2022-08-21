import { useEffect } from 'react';
import AxiosConfig from '../Services/AxiosConfig';

const Logout = () => {
    useEffect(() => {
        const data={key:localStorage.getItem('_authToken')};
        AxiosConfig.post("users/logout",data).then(
            (succ) => {
                debugger;
                localStorage.setItem('_authToken', '');
                localStorage.setItem('user_type', '');
                localStorage.setItem('user_id', '');
                localStorage.setItem('username', '');
                localStorage.setItem('product_id', '');
                // alert("User has been logged out successfully!");
                window.location.href="/";
            },
            (err) => {
                debugger;
            }
        );
    }, []);
}

export default Logout