import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const ChangePassBody = () => {
    const [vendor, setVendor] = useState({});

    const [current_pass, setCurrent_pass] = useState("");
    const [new_pass, setNew_pass] = useState("");
    const [confirm_pass, setConfirm_pass] = useState("");

    const [msg, setMsg] = useState("");
    const [errors, setErrors] = useState([]);
    
    useEffect(() => {
        document.title='Change Password';
        AxiosConfig.get("vendor/profile/"+localStorage.getItem('user_id')).then(
            (succ) => {
                setVendor(succ.data);
                // debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);

    const handleForm = (event) => {
        event.preventDefault();
        const data = { current_pass: current_pass, new_pass: new_pass, confirm_pass: confirm_pass };
        // console.log(data);
        AxiosConfig.post("vendor/changePass", data).
            then((succ) => {
                setMsg(succ.data.msg);
                debugger;
                alert(succ.data.msg);
                window.location.href = "/vendor/profile";
            }, (err) => {
                debugger;
                setErrors(err.response.data);
                // console.log(err.response.data);
            })
    }

    // const remove = () => {
    //     setMsg("");
    //     window.location.href = "/customer/profileinfo";
    // }

    return (
        <>
            {/* {
                msg ?
                    <div className="container mt-3">
                        <div className="alert alert-primary alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                            <strong>Success!</strong> {msg}
                        </div>
                    </div>
                    : ''
            } */}
            <div className="container-fluid p-4">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Password Change</h3>
                    </div>
                    <div className="card-body">

                        <div className="row">
                        <div className="col-4">
                            <div className="card mb-4 mt-1">
                                <div className="card-body text-center">
                                    <img src={`http://127.0.0.1:8000/storage/vendor_profile_images/${vendor.propic}`} alt="Vendor Avatar"
                                    className="rounded" style={{ width: "150px" }} />
                                    <h5 className="my-3">{vendor.username}</h5>
                                    <p className="text-muted mb-1">Vendor, Grocery OS</p>
                                    <p className="text-muted mb-4">{vendor.address}</p>
                                    <div className="d-flex justify-content-center mb-2">
                                        <button type="button" className="btn btn-primary"><Link className='nav-link' to={`/vendor/editProfile/${vendor.id}`}>Edit Profile</Link></button>
                                        <button type="button" className="btn btn-outline-primary ms-1"><Link className='nav-link' to="/vendor/profile">Go Back</Link></button>
                                    </div>
                                </div>
                            </div>
                        </div>


                            <div className="col-8" style={{ paddingTop: "70px" }}>
                                <div className="card">
                                    <div className="card-body">
                                        <div className="user-details">
                                            <div className="row">
                                                <div className="col">
                                                    <h6 className="mb-2 text-primary">Password Change</h6>
                                                </div>

                                                <form className="form" onSubmit={handleForm}>
                                                    <div className="row py-1">
                                                        <div className="col-12">
                                                            <label htmlFor="id">Current Password</label>
                                                            <input type="password" className="form-control" name='current_pass' placeholder="Enter current password" value={current_pass} onChange={(e) => { setCurrent_pass(e.target.value) }} />
                                                        </div>
                                                        <span className="text-danger">{errors.current_pass ? errors.current_pass[0] : ''}</span>
                                                    </div>

                                                    <div className="row py-1">
                                                        <div className="col-6">
                                                            <label htmlFor="userame">New Password</label>
                                                            <input type="password" className="form-control" name='new_pass' placeholder="Enter new password" value={new_pass} onChange={(e) => { setNew_pass(e.target.value) }} />
                                                            <span className="text-danger">{errors.new_pass ? errors.new_pass[0] : ''}</span>
                                                        </div>

                                                        <div className="col-6">
                                                            <label htmlFor="Name">Confirm New Password</label>
                                                            <input type="password" className="form-control" name='confirm_pass' placeholder="Retype new password"
                                                                value={confirm_pass} onChange={(e) => { setConfirm_pass(e.target.value) }} />
                                                            <span className="text-danger">{errors.confirm_pass ? errors.confirm_pass[0] : ''}</span>
                                                        </div>

                                                    </div>

                                                    <div className="row pt-2">
                                                        <div className="d-flex mb-2">
                                                            <button type="submit" className="btn btn-primary">Update</button>
                                                            <button type="button" className="btn btn-outline-primary ms-1"><Link className='nav-link' to="#">Forgot Password</Link></button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </>
    )
}

export default ChangePassBody