import { useEffect } from 'react';
import AxiosConfig from '../Services/AxiosConfig';

const Logout = () => {
    useEffect(() => {
        const data={key:localStorage.getItem('_authToken')};
        AxiosConfig.post("users/logout",data).then(
            (succ) => {
                debugger;

                localStorage.removeItem('_authToken', '');
                localStorage.setItem('user_type', '');
                localStorage.removeItem('user_id', '');
                localStorage.removeItem('username', '');
                localStorage.removeItem('product_id', '');
                localStorage.removeItem('email', '');
                localStorage.removeItem('msg', '');
                localStorage.removeItem('errmsg', '');

                localStorage.setItem('loggedout', "yes");

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