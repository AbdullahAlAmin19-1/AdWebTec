import { useState, useEffect } from 'react';
import AxiosConfig from '../Services/AxiosConfig';
import { Link } from "react-router-dom";

const LoginBody = () => {
    const [user, setUser] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    const [msg, setMsg] = useState(localStorage.getItem('msg'));
    const [errmsg, setErrMsg] = useState(localStorage.getItem('errmsg'));
    const [errors, setErrors] = useState([]);
    useEffect(() => {
        document.title = 'Grocery OS - Login';
    }, []);
    const handleForm = (event) => {
        event.preventDefault();
        const data = { user_type: user, email: email, password: password, };
        AxiosConfig.post("users/login", data).
            then((succ) => {
                debugger;
                setMsg(succ.data.msg)
                setErrMsg(succ.data.errmsg)

                if (succ.data.user) {

                    localStorage.setItem('user_type', succ.data.user_type);
                    localStorage.setItem('user_id', succ.data.user.id);
                    localStorage.setItem('username', succ.data.user.username);
                    localStorage.setItem('_authToken', succ.data.token.token_key);
                    localStorage.setItem('msg', '');
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
                setErrors(err.response.data);
            })
    }

    const remove = () => {
        localStorage.setItem('msg', '');
        localStorage.setItem('errmsg', '');
        setMsg("");
        window.location.href = "/login";
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
                        <div className="col-6 bg-white" style={{ paddingTop: "90px" }}>
                            <form action="" onSubmit={handleForm}>
                                <div className="card-body p-md-5 text-black">
                                    <h3 className="mb-5 text-uppercase">Login form</h3>

                                    <div className="row">


                                        <span className="text-danger">{errors.user_type ? errors.user_type : ''}</span>

                                        <div className="d-md-flex mb-4 py-2">

                                            <h6 className="mb-1 p-1">Login as:  </h6>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user"
                                                    id="admin" value="Admin" onClick={(e) => { setUser(e.target.value) }} />
                                                <label className="form-check-label" htmlFor="admin">Admin</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user"
                                                    id="vendor" value="Vendor" onClick={(e) => { setUser(e.target.value) }} />
                                                <label className="form-check-label" htmlFor="vendor">Vendor</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user"
                                                    id="customer" value="Customer" onClick={(e) => { setUser(e.target.value) }} />
                                                <label className="form-check-label" htmlFor="customer">Customer</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user"
                                                    id="deliveryman" value="Deliveryman" onClick={(e) => { setUser(e.target.value) }} />
                                                <label className="form-check-label" htmlFor="deliveryman">Deliveryman</label>
                                            </div>

                                        </div>
                                        <div className="form-outline">
                                            <label className="form-label" htmlFor="email">Email</label>
                                            <input type="email" name="email" className="form-control form-control-lg" value={email} onChange={(e) => { setEmail(e.target.value) }} />
                                            <span className="text-danger">{errors.email ? errors.email[0] : ''}</span>
                                        </div>
                                        <div className="form-outline">
                                            <label className="form-label" htmlFor="password">Password</label>
                                            <input type="password" name="password" className="form-control form-control-lg" value={password} onChange={(e) => { setPassword(e.target.value) }} />
                                            <span className="text-danger">{errors.password ? errors.password[0] : ''}</span>
                                        </div>
                                    </div>
                                    <div className="d-flex justify-content-end pt-1">
                                        <button type="button" className="btn btn-light btn-lg">
                                            <Link className="nav-link" to="/registration">Create an account?</Link>
                                        </button>
                                        <button type="submit" className="btn btn-warning btn-lg ms-2">Login</button>
                                    </div>
                                    <br />
                                    <button type="button" className="btn btn-light btn-lg">
                                        <Link className="nav-link" to="/forgotPass">Forgot Password?</Link>
                                    </button>

                                    <button type="button" className="btn btn-warning btn-lg ms-2">
                                        <Link className="nav-link" to="/emailLogin">Login Using only Email</Link>
                                    </button>


                                    {
                                        errmsg ?
                                            <div className="container mt-3">
                                                <div className="alert alert-danger alert-dismissible">
                                                    <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                                                    <strong>Warning!</strong> {errmsg}
                                                </div>
                                            </div>
                                            : ''
                                    }

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


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default LoginBody