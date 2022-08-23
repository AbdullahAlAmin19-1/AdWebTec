import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import { Link } from "react-router-dom";

const EmailLoginBody = () => {
    const [user, setUser] = useState("");
    const [email, setEmail] = useState("");

    const [msg, setMsg] = useState("");
    const [errmsg, setErrMsg] = useState("");
    const [errors, setErrors] = useState([]);

    useEffect(() => {
        document.title='Email Login';
      }, []);


    const handleForm = (event) => {
        event.preventDefault();
        const data = { user_type: user, email: email};
        AxiosConfig.post("users/emailLogin", data).
            then((succ) => {
                debugger;
                setMsg(succ.data.msg)
                setErrMsg(succ.data.errmsg);
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
        window.location.href = "/login";
    }
    return (
        <>
            
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
                                    <h3 className="mb-5 text-uppercase">Email Login</h3>

                                    <div className="row">
                                    <span className="text-danger">{errors.user_type ? errors.user_type : ''}</span>

<div className="d-md-flex mb-4 py-2">

    <h6 className="mb-1 p-1">User Type:  </h6>

    <div className="form-check form-check-inline mb-0">
        <input className="form-check-input" type="radio" name="user"
            id="admin" value="Admin" onClick={(e) => { setUser(e.target.value) }} />
        <label className="form-check-label" for="admin">Admin</label>
    </div>

    <div className="form-check form-check-inline mb-0">
        <input className="form-check-input" type="radio" name="user"
            id="vendor" value="Vendor" onClick={(e) => { setUser(e.target.value) }} />
        <label className="form-check-label" for="vendor">Vendor</label>
    </div>

    <div className="form-check form-check-inline mb-0">
        <input className="form-check-input" type="radio" name="user"
            id="customer" value="Customer" onClick={(e) => { setUser(e.target.value) }} />
        <label className="form-check-label" for="customer">Customer</label>
    </div>

    <div className="form-check form-check-inline mb-0">
        <input className="form-check-input" type="radio" name="user"
            id="deliveryman" value="Deliveryman" onClick={(e) => { setUser(e.target.value) }} />
        <label className="form-check-label" for="deliveryman">Deliveryman</label>
    </div>

</div>
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

export default EmailLoginBody