import { useEffect } from 'react';
import AxiosConfig from '../Services/AxiosConfig';

const Logout = () => {
    useEffect(() => {
        const data={key:localStorage.getItem('_authToken')};
        AxiosConfig.post("users/logout",data).then(
            (succ) => {
                // debugger;
                alert("User has been logged out successfully!");
                console.log(succ.data);
                window.location.href="/";
            },
            (err) => {
                debugger;
            }
        );
    }, []);
}

export default Logout