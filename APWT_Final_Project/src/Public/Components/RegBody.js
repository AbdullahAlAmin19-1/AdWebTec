import { useState } from 'react';
import axios from 'axios';

const RegBody = () => {
    const [user, setUser] = useState("");
    const [name, setName] = useState("");
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [phone, setPhone] = useState("");
    const [password, setPassword] = useState("");
    const [conf_pass, setConfPass] = useState("");
    const [gender, setGender] = useState("");
    const [dob, setDob] = useState("");
    const [address, setAddress] = useState("");

    const handleForm = (event) => {
        event.preventDefault();
        const data={name:name,username:username,email:email,phone:phone,password:password,conf_pass:conf_pass,gender:gender,dob:dob,address:address};
        // alert(data.name);
        axios.post("http://localhost:8000/api/vendors/registration",data).
        then((succ)=>{
            //setMsg(succ.data.msg);
            alert("Ok");
        },(err)=>{
            debugger;
            // setErrs(err.response.data);
        })
    }
    
    return (
        <>
            <section className="bg-dark">
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-registration my-4">
                                <div className="row g-0">
                                    <div className="col-xl-6 d-none d-xl-block">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                            alt="Sample photo" className="img-fluid"
                                            style={{ bordertopleftradius: ".25rem", borderbottomleftradius: ".25rem;" }} />
                                    </div>
                                    <div className="col-xl-6">
                                        <form action="" onSubmit={handleForm}>
                                        <div className="card-body p-md-5 text-black">
                                            <h3 className="mb-5 text-uppercase">Registration form</h3>

                                            <div className="row">
                                            <div className="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                            <h6 className="mb-0 me-4">Register as: </h6>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user_type"
                                                    value="Vendor" onClick={(e) => { setUser(e.target.value) }}/>
                                                <label className="form-check-label" for="vendor">Vendor</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user_type"
                                                    value="Customer" onClick={(e) => { setUser(e.target.value) }}/>
                                                <label className="form-check-label" for="customer">Customer</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user_type"
                                                    value="Deliveryman" onClick={(e) => { setUser(e.target.value) }}/>
                                                <label className="form-check-label" for="deliveryman">Deliveryman</label>
                                            </div>

                                            </div>
                                                <div className="col-md-6">
                                                    <div className="form-outline">
                                                        <input type="text" name="name" className="form-control form-control-lg" value={name} onChange={(e) => { setName(e.target.value) }} />
                                                        <label className="form-label" for="name">Name</label>
                                                    </div>
                                                </div>
                                                <div className="col-md-6">
                                                    <div className="form-outline">
                                                        <input type="text" name="username" className="form-control form-control-lg" value={username} onChange={(e) => { setUsername(e.target.value) }}/>
                                                        <label className="form-label" for="username">Username</label>
                                                    </div>
                                                </div>
                                                <div className="form-outline">
                                                        <input type="email" name="email" className="form-control form-control-lg" value={email} onChange={(e) => { setEmail(e.target.value) }}/>
                                                        <label className="form-label" for="email">Email</label>
                                                </div>
                                                <div className="form-outline">
                                                        <input type="text" name="phone" className="form-control form-control-lg" value={phone} onChange={(e) => { setPhone(e.target.value) }}/>
                                                        <label className="form-label" for="phone">Phone</label>
                                                </div>
                                                <div className="form-outline">
                                                        <input type="password" name="password" className="form-control form-control-lg" value={password} onChange={(e) => { setPassword(e.target.value) }}/>
                                                        <label className="form-label" for="password">Password</label>
                                                </div>
                                                <div className="form-outline">
                                                        <input type="password" name="conf_password" className="form-control form-control-lg" value={conf_pass} onChange={(e) => { setConfPass(e.target.value) }}/>
                                                        <label className="form-label" for="conf_password">Confirm Password</label>
                                                </div>
                                            </div>

                                            <div className="d-md-flex justify-content-start align-items-center py-2">

                                                <h6 className="mb-0 me-4">Gender: </h6>

                                                <div className="form-check form-check-inline mb-0 me-4">
                                                    <input className="form-check-input" type="radio" name="gender"
                                                        value="Female" onClick={(e) => { setGender(e.target.value) }}/>
                                                    <label className="form-check-label" for="femaleGender">Female</label>
                                                </div>

                                                <div className="form-check form-check-inline mb-0 me-4">
                                                    <input className="form-check-input" type="radio" name="gender"
                                                        value="Male" onClick={(e) => { setGender(e.target.value) }}/>
                                                    <label className="form-check-label" for="maleGender">Male</label>
                                                </div>

                                                <div className="form-check form-check-inline mb-0">
                                                    <input className="form-check-input" type="radio" name="gender"
                                                        value="Others" onClick={(e) => { setGender(e.target.value) }}/>
                                                    <label className="form-check-label" for="otherGender">Other</label>
                                                </div>

                                            </div>

                                            <div className="form-outline">
                                                <input type="date" name="dob" className="form-control form-control-lg"
                                                 value={dob} onChange={(e) => { setDob(e.target.value) }}/>
                                                <label className="form-label" for="dob">DOB</label>
                                            </div>

                                            <div className="form-outline">
                                                <input type="text" name="address" className="form-control form-control-lg" value={address} onChange={(e) => { setAddress(e.target.value) }}/>
                                                <label className="form-label" for="address">Address</label>
                                            </div>

                                            <div className="d-flex justify-content-end pt-1">
                                                <button type="button" className="btn btn-light btn-lg">Already have an account?</button>
                                                <button type="submit" className="btn btn-warning btn-lg ms-2">Register</button>
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