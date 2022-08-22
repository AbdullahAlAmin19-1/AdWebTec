import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const NoticesBody = () => {

    const [notices, setNotices] = useState([]);
    const [errmsg, setErrMsg] = useState("");

    useEffect(() => {
        document.title = 'Grocery OS - Notices';

        AxiosConfig.get("vendor/notices/" + localStorage.getItem('user_id')).then(
            (succ) => {
                setNotices(succ.data);
                // console.log(succ.data);
                // debugger;

                if (succ.data.errmsg) 
                {
                    localStorage.setItem('errmsg', succ.data.errmsg);
                    window.location.href = "/vendor/profile";
                }
            },
            (err) => {
                debugger;
            }

        );
    }, []);

    return (
        <>
            <div className="container-fluid p-4 text-center">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Vendor Notices</h3>
                    </div>
                    <div className="card-body">

                        <div className="row justify-content-center">

                            {
                                notices.map((item) =>
                                    <>
                                        <div className="col-6 py-2" key={item.id}>
                                            <div className="card">
                                                <div className="card-header bg-primary text-white">
                                                    {item.subject}
                                                </div>
                                                <div className="card-body">
                                                    <h5 className="card-title p-3">{item.message}</h5>
                                                    <p className="card-text">- Admin</p>
                                                    <sup>Received On: {item.updated_at}</sup>
                                                </div>
                                            </div>
                                        </div>

                                    </>
                                )
                            }

                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export default NoticesBody