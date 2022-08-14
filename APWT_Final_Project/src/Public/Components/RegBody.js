import { useState } from 'react';
import AxiosConfig from '../Services/AxiosConfig';
import { Link } from 'react-router-dom';

const RegBody = () => {
    const [user, setUser] = useState("");
    const [name, setName] = useState("");
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [phone, setPhone] = useState("");
    const [password, setPassword] = useState("");
    const [conf_password, setConfPassword] = useState("");
    const [gender, setGender] = useState("");
    const [dob, setDob] = useState("");
    const [address, setAddress] = useState("");

    const [errors, setErrors] = useState([]);

    const handleForm = (event) => {
        event.preventDefault();
        const data = { user_type: user, name: name, username: username, email: email, phone: phone, password: password, conf_password: conf_password, gender: gender, dob: dob, address: address };
        // alert(data.name);
        AxiosConfig.post("users/registration", data).
            then((succ) => {
                //setMsg(succ.data.msg);
                debugger;

                alert("Ok");
                window.location.href = "/login";
            }, (err) => {
                debugger;
                setErrors(err.response.data);
                console.log(errors.gender);
            })
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
                        <div className="col-6 bg-white">
                            <form action="" onSubmit={handleForm}>
                                <div className="card-body p-5">
                                    <h3 className="mb-5 text-uppercase">Registration form</h3>

                                    <div className="row">

                                    <span className="text-danger">{errors.user_type ? errors.user_type : ''}</span>
                                    
                                        <div className="d-md-flex mb-4 py-2">

                                            <h6 className="mb-0 me-4">Register as: </h6>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user_type"
                                                    id="vendor" value="Vendor" onClick={(e) => { setUser(e.target.value) }} />
                                                <label className="form-check-label" htmlFor="vendor">Vendor</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user_type"
                                                    id="customer" value="Customer" onClick={(e) => { setUser(e.target.value) }} />
                                                <label className="form-check-label" htmlFor="customer">Customer</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user_type"
                                                    id="deliveryman" value="Deliveryman" onClick={(e) => { setUser(e.target.value) }} />
                                                <label className="form-check-label" htmlFor="deliveryman">Deliveryman</label>
                                            </div>

                                        </div>

                                        <div className="col-md-6">
                                            <label className="form-label" htmlFor="name">Name</label>
                                            <div className="form-outline">
                                                <input type="text" name="name" className="form-control form-control-lg" value={name} onChange={(e) => { setName(e.target.value) }} />

                                                <span className="text-danger">{errors.name ? errors.name[0] : ''}</span>

                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <label className="form-label" htmlFor="username">Username</label>
                                            <div className="form-outline">
                                                <input type="text" name="username" className="form-control form-control-lg" value={username} onChange={(e) => { setUsername(e.target.value) }} />

                                                <span className="text-danger">{errors.username ? errors.username[0] : ''}</span>

                                            </div>
                                        </div>
                                        <label className="form-label" htmlFor="email">Email</label>
                                        <div className="form-outline">
                                            <input type="email" name="email" className="form-control form-control-lg" value={email} onChange={(e) => { setEmail(e.target.value) }} />

                                            <span className="text-danger">{errors.email ? errors.email[0] : ''}</span>

                                        </div>
                                        <label className="form-label" htmlFor="phone">Phone</label>
                                        <div className="form-outline">
                                            <input type="text" name="phone" className="form-control form-control-lg" value={phone} onChange={(e) => { setPhone(e.target.value) }} />

                                            <span className="text-danger">{errors.phone ? errors.phone[0] : ''}</span>

                                        </div>
                                        <label className="form-label" htmlFor="password">Password</label>
                                        <div className="form-outline">
                                            <input type="password" name="password" className="form-control form-control-lg" value={password} onChange={(e) => { setPassword(e.target.value) }} />

                                            <span className="text-danger">{errors.password ? errors.password[0] : ''}</span>

                                        </div>
                                        <label className="form-label" htmlFor="conf_password">Confirm Password</label>
                                        <div className="form-outline">
                                            <input type="password" name="conf_password" className="form-control form-control-lg" value={conf_password} onChange={(e) => { setConfPassword(e.target.value) }} />

                                            <span className="text-danger">{errors.conf_password ? errors.conf_password[0] : ''}</span>

                                        </div>
                                    </div>

                                    <div className="d-md-flex justify-content-start align-items-center py-2">

                                        <h6 className="mb-0 me-4">Gender: </h6>

                                        <div className="form-check form-check-inline mb-0 me-4">
                                            <input className="form-check-input" type="radio" name="gender"
                                                value="Male" onClick={(e) => { setGender(e.target.value) }} />
                                            <label className="form-check-label" htmlFor="maleGender">Male</label>
                                        </div>

                                        <div className="form-check form-check-inline mb-0 me-4">
                                            <input className="form-check-input" type="radio" name="gender"
                                                value="Female" onClick={(e) => { setGender(e.target.value) }} />
                                            <label className="form-check-label" htmlFor="femaleGender">Female</label>
                                        </div>

                                        <div className="form-check form-check-inline mb-0">
                                            <input className="form-check-input" type="radio" name="gender"
                                                value="Others" onClick={(e) => { setGender(e.target.value) }} />
                                            <label className="form-check-label" htmlFor="otherGender">Other</label>
                                        </div>

                                        <span className="text-danger">{errors.gender ? errors.gender : ''}</span>

                                    </div>

                                    <label className="form-label" htmlFor="dob">DOB</label>
                                    <div className="form-outline">
                                        <input type="date" name="dob" className="form-control form-control-lg"
                                            value={dob} onChange={(e) => { setDob(e.target.value) }} />

                                        <span className="text-danger">{errors.dob ? errors.dob[0] : ''}</span>

                                    </div>

                                    <label className="form-label" htmlFor="address">Address</label>
                                    <div className="form-outline">
                                        <input type="text" name="address" className="form-control form-control-lg" value={address} onChange={(e) => { setAddress(e.target.value) }} />

                                        <span className="text-danger">{errors.address ? errors.address[0] : ''}</span>

                                    </div>

                                    <div className="d-flex justify-content-end pt-1">
                                        <button type="button" className="btn btn-light btn-lg"><Link to="/login" className="nav-link">Already have an account?</Link></button>
                                        <button type="submit" className="btn btn-warning btn-lg ms-2">Register</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>





            {/* Previous Design */}

            {/* <section className="bg-dark">
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-registration my-4">
                                <div className="row g-0">
                                    <div className="col-xl-5 d-none d-xl-block">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                            alt="Sample photo" className="img-fluid"
                                            style={{ bordertopleftradius: ".25rem", borderbottomleftradius: ".25rem;" }} />
                                    </div>
                                    <div className="col-xl-7">
                                        <form action="" onSubmit={handleForm}>
                                            <div className="card-body p-md-5 text-black">
                                                <h3 className="mb-5 text-uppercase">Registration form</h3>

                                                <div className="row">
                                                    <div className="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                                        <h6 className="mb-0 me-4">Register as: </h6>

                                                        <div className="form-check form-check-inline mb-0">
                                                            <input className="form-check-input" type="radio" name="user_type"
                                                                id="vendor" value="Vendor" onClick={(e) => { setUser(e.target.value) }} />
                                                            <label className="form-check-label" htmlFor="vendor">Vendor</label>
                                                        </div>

                                                        <div className="form-check form-check-inline mb-0">
                                                            <input className="form-check-input" type="radio" name="user_type"
                                                                id="customer" value="Customer" onClick={(e) => { setUser(e.target.value) }} />
                                                            <label className="form-check-label" htmlFor="customer">Customer</label>
                                                        </div>

                                                        <div className="form-check form-check-inline mb-0">
                                                            <input className="form-check-input" type="radio" name="user_type"
                                                                id="deliveryman" value="Deliveryman" onClick={(e) => { setUser(e.target.value) }} />
                                                            <label className="form-check-label" htmlFor="deliveryman">Deliveryman</label>
                                                        </div>

                                                    </div>
                                                    <div className="col-md-6">
                                                        <div className="form-outline">
                                                            <input type="text" name="name" className="form-control form-control-lg" value={name} onChange={(e) => { setName(e.target.value) }} />
                                                            <label className="form-label" htmlFor="name">Name</label>
                                                        </div>
                                                    </div>
                                                    <div className="col-md-6">
                                                        <div className="form-outline">
                                                            <input type="text" name="username" className="form-control form-control-lg" value={username} onChange={(e) => { setUsername(e.target.value) }} />
                                                            <label className="form-label" htmlFor="username">Username</label>
                                                        </div>
                                                    </div>
                                                    <div className="form-outline">
                                                        <input type="email" name="email" className="form-control form-control-lg" value={email} onChange={(e) => { setEmail(e.target.value) }} />
                                                        <label className="form-label" htmlFor="email">Email</label>
                                                    </div>
                                                    <div className="form-outline">
                                                        <input type="text" name="phone" className="form-control form-control-lg" value={phone} onChange={(e) => { setPhone(e.target.value) }} />
                                                        <label className="form-label" htmlFor="phone">Phone</label>
                                                    </div>
                                                    <div className="form-outline">
                                                        <input type="password" name="password" className="form-control form-control-lg" value={password} onChange={(e) => { setPassword(e.target.value) }} />
                                                        <label className="form-label" htmlFor="password">Password</label>
                                                    </div>
                                                    <div className="form-outline">
                                                        <input type="password" name="conf_password" className="form-control form-control-lg" value={conf_pass} onChange={(e) => { setConfPass(e.target.value) }} />
                                                        <label className="form-label" htmlFor="conf_password">Confirm Password</label>
                                                    </div>
                                                </div>

                                                <div className="d-md-flex justify-content-start align-items-center py-2">

                                                    <h6 className="mb-0 me-4">Gender: </h6>

                                                    <div className="form-check form-check-inline mb-0 me-4">
                                                        <input className="form-check-input" type="radio" name="gender"
                                                            value="Female" onClick={(e) => { setGender(e.target.value) }} />
                                                        <label className="form-check-label" htmlFor="femaleGender">Female</label>
                                                    </div>

                                                    <div className="form-check form-check-inline mb-0 me-4">
                                                        <input className="form-check-input" type="radio" name="gender"
                                                            value="Male" onClick={(e) => { setGender(e.target.value) }} />
                                                        <label className="form-check-label" htmlFor="maleGender">Male</label>
                                                    </div>

                                                    <div className="form-check form-check-inline mb-0">
                                                        <input className="form-check-input" type="radio" name="gender"
                                                            value="Others" onClick={(e) => { setGender(e.target.value) }} />
                                                        <label className="form-check-label" htmlFor="otherGender">Other</label>
                                                    </div>

                                                </div>

                                                <div className="form-outline">
                                                    <input type="date" name="dob" className="form-control form-control-lg"
                                                        value={dob} onChange={(e) => { setDob(e.target.value) }} />
                                                    <label className="form-label" htmlFor="dob">DOB</label>
                                                </div>

                                                <div className="form-outline">
                                                    <input type="text" name="address" className="form-control form-control-lg" value={address} onChange={(e) => { setAddress(e.target.value) }} />
                                                    <label className="form-label" htmlFor="address">Address</label>
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
            </section> */}
        </>
    )
}

export default RegBody