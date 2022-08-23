import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import { Link } from "react-router-dom";

const EnterOTPBody = () => {
    const [user, setUser] = useState(localStorage.getItem('user_type'));
    const [username, setUserName] = useState(localStorage.getItem('username'));
    const [email, setEmail] = useState(localStorage.getItem('email'));
    const [otp, setOTP] = useState("");

    const [msg, setMsg] = useState(localStorage.getItem('msg'));
    const [errmsg, setErrMsg] = useState("");

    useEffect(() => {
        document.title = 'Enter OTP';
    }, []);

    const handleForm = (event) => {
        event.preventDefault();
        const data = { user_type: user, email: email, otp: otp };
        AxiosConfig.post("users/enterOTP", data).
            then((succ) => {
                debugger;
                // setMsg(succ.data.msg)
                if (succ.data.errmsg) {
                    setMsg('')
                    setErrMsg(succ.data.errmsg);
                }
                else {
                    localStorage.setItem('msg', succ.data.msg);
                    window.location.href = "/createNewPass";
                }

            }, (err) => {
                debugger;
                // console.log(errors.email[0]);
            })
    }
    const remove = () => {
        localStorage.setItem('msg', '');
        localStorage.setItem('errmsg', '');
        setMsg("");
        setErrMsg("");
    }
    return (
        <>
            <section className="bg-dark">
                <div className="container-fluid">
                    <div className="row px-5 py-4">
                        <div className="col-6">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                alt="Sample photo" className="img-fluid" />
                        </div>
                        <div className="col-6 bg-white" style={{ paddingTop: "130px" }}>
                            <form action="" onSubmit={handleForm}>
                                <div className="card-body p-md-5 text-black">
                                    <h3 className="mb-5 text-uppercase">Enter OTP</h3>

                                    <div className="row">
                                        <div className="form-outline">
                                            <label className="form-label" htmlFor="username">User Name</label>
                                            <input type="text" name="username" className="form-control form-control-lg" value={username} disabled />
                                        </div>
                                        <div className="form-outline">
                                            <label className="form-label" htmlFor="email">Email</label>
                                            <input type="email" name="email" className="form-control form-control-lg" value={email} disabled />
                                        </div>
                                        <div className="form-outline">
                                            <label className="form-label" htmlFor="otp">OTP</label>
                                            <input type="text" name="otp" className="form-control form-control-lg" value={otp} onChange={(e) => { setOTP(e.target.value) }} />
                                        </div>

                                    </div>
                                    <div className="d-flex justify-content-end pt-1">
                                        <button type="submit" className="btn btn-warning btn-lg ms-2">Submit</button>
                                    </div>

                                    <div>
                                        {
                                            msg ?
                                                <div className="container mt-3">
                                                    <div className="alert alert-success alert-dismissible">
                                                        <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                                                        <strong>Success!</strong> {msg}
                                                    </div>
                                                </div>
                                                : ''
                                        }
                                        {
                                            errmsg ?
                                                <div className="container mt-3">
                                                    <div className="alert alert-danger alert-dismissible">
                                                        <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                                                        <strong>Failed!</strong> {errmsg}
                                                    </div>
                                                </div>
                                                : ''
                                        }
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default EnterOTPBody