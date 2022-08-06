import { useState } from 'react';
import axios from 'axios';
import { Link } from "react-router-dom";

const RegBody = () => {
    const [user, setUser] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    const handleForm = (event) => {
        event.preventDefault();
        const data={user_type:user,email:email,password:password,};
        console.log(data);
        // alert(data.name);
        axios.post("http://localhost:8000/api/users/login",data).
        then((succ)=>{
            alert("Ok");
            console.log(succ.data);
            if(succ.data.user_type=='Admin'){window.location.href="/customer/profileinfo";}
            if(succ.data.user_type=='Vendor'){window.location.href="/vendor/profile";}
            if(succ.data.user_type=='Customer'){window.location.href="/customer/profileinfo";}
            if(succ.data.user_type=='Deliveryman'){window.location.href="/customer/profileinfo";}
            
        },(err)=>{
            debugger;
        })
    }
    
    return (
        <>
            <section className="bg-dark">
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-login my-4">
                                <div className="row g-0">
                                    <div className="col-xl-6 d-none d-xl-block">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                            alt="Sample photo" className="img-fluid"
                                            style={{ bordertopleftradius: ".25rem", borderbottomleftradius: ".25rem;" }} />
                                    </div>
                                    <div className="col-xl-6">
                                        <form action="" onSubmit={handleForm}>
                                        <div className="card-body p-md-5 text-black">
                                            <h3 className="mb-5 text-uppercase">Login form</h3>

                                            <div className="row">
                                            <div className="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                            <h6 className="mb-0 me-4">Login as: </h6>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user"
                                                    value="Vendor" onClick={(e) => { setUser(e.target.value) }}/>
                                                <label className="form-check-label" for="vendor">Vendor</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user"
                                                    value="Customer" onClick={(e) => { setUser(e.target.value) }}/>
                                                <label className="form-check-label" for="customer">Customer</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user"
                                                    value="Deliveryman" onClick={(e) => { setUser(e.target.value) }}/>
                                                <label className="form-check-label" for="deliveryman">Deliveryman</label>
                                            </div>

                                            </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="email">Email</label>
                                                        <input type="email" name="email" className="form-control form-control-lg" value={email} onChange={(e) => { setEmail(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="password">Password</label>
                                                        <input type="password" name="password" className="form-control form-control-lg" value={password} onChange={(e) => { setPassword(e.target.value) }}/>
                                                </div>
                                            </div>
                                            <div className="d-flex justify-content-end pt-1">
                                                <button type="button" className="btn btn-light btn-lg">
                                                <Link className="nav-link" to="/registration">Create an account?</Link>
                                                </button>
                                                <button type="submit" className="btn btn-warning btn-lg ms-2">Login</button>
                                            </div>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default RegBody