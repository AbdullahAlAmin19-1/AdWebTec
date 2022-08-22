import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import { Link } from "react-router-dom";

const ForgotPassBody = () => {
    const [user, setUser] = useState(localStorage.getItem('user_type'));
    const [email, setEmail] = useState("");

    const [msg, setMsg] = useState("");
    const [errmsg, setErrMsg] = useState(localStorage.getItem('errmsg'));
    const [errors, setErrors] = useState([]);

    useEffect(() => {
        document.title='Forgot Password';
        AxiosConfig.post("vendor/forgotPass").
        then((succ)=>{
            debugger;
        },(err)=>{
            debugger;
        })
      }, []);


    const handleForm = (event) => {
        event.preventDefault();
        const data = { user_type: user, email: email};
        AxiosConfig.post("vendor/forgotPass", data).
            then((succ) => {
                debugger;
                setMsg(succ.data.msg)

                if (succ.data.errmsg) 
                {
                    setErrMsg(succ.data.errmsg);
                }
                else{
                    localStorage.setItem('msg', succ.data.msg);
                    localStorage.setItem('email', email);
                    localStorage.setItem('otp', succ.data.otp);
                    window.location.href = "/vendor/enterOTP";
                }

            }, (err) => {
                debugger;
                setErrors(err.response.data);
                // console.log(errors.email[0]);
            })
    }
    const remove = () => {
        localStorage.setItem('msg', '');
        localStorage.setItem('errmsg', '');
        setErrMsg("");
        window.location.href = "/vendor/forgotPass";
    }
    return (
        <>
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
                                    <h3 className="mb-5 text-uppercase">Forgot Password</h3>

                                    <div className="row">

                                        <div className="form-outline">
                                            <label className="form-label" for="email">Email</label>
                                            <input type="email" name="email" className="form-control form-control-lg" value={email} onChange={(e) => { setEmail(e.target.value) }} />
                                            <span className="text-danger">{errors.email ? errors.email[0] : ''}</span>
                                        </div>
                                        
                                    </div>
                                    <div className="d-flex justify-content-end pt-1">
                                        
                                        <button type="submit" className="btn btn-warning btn-lg ms-2">Submit</button>
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

export default ForgotPassBody