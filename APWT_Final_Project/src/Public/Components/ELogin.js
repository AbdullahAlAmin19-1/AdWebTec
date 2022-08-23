import { useEffect } from 'react';
import { useParams } from "react-router-dom"
import AxiosConfig from '../Services/AxiosConfig';

const ELogin = () => {
    const{user_type} = useParams();
    const{username} = useParams();
    const{id} = useParams();

    useEffect(() => {
        AxiosConfig.post("users/eLogout/",+user_type+"/"+username+"/"+id).then(
            (succ) => {
                debugger;
                if (succ.data.user) {

                    localStorage.setItem('user_type', succ.data.user_type);
                    localStorage.setItem('user_id', succ.data.user.id);
                    localStorage.setItem('username', succ.data.user.username);
                    localStorage.setItem('_authToken', succ.data.token.token_key);
                    localStorage.setItem('msg', succ.data.msg);
                    localStorage.setItem('errmsg', '');

                    if (succ.data.user_type == 'Admin') { window.location.href = "/admin/dashboard"; }
                    if (succ.data.user_type == 'Vendor') { window.location.href = "/vendor/profile"; }
                    if (succ.data.user_type == 'Customer') { window.location.href = "/customer/profileinfo"; }
                    if (succ.data.user_type == 'Deliveryman') { window.location.href = "/customer/profileinfo"; }

                }
                else {
                    // alert(msg)
                }

            }, (err) => {
                debugger;
            })
    }, []);
    
  return (
    <>
      {/* {user_type}<br/>
      {username}<br/>
      {id} */}
    </>
  )
}

export default ELogin