import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const Profile = () => {
    const [admin, setAdmin] = useState({});

    useEffect(() => {
        document.title='Profile'; //Setting dummy value

        AxiosConfig.get("admin/profile/"+localStorage.getItem('user_id')).then(
            (res) => {
                setAdmin(res.data);
                // debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);

    return (
        <>

            <div className="container-fluid p-4">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Admin Profile</h3>
                    </div>
                    <div className="card-body">

                        <div className="row">
                            <div className="col-4">
                                <div className="card mb-4 mt-1">
                                    <div className="card-body text-center">
                                        <img src={`http://127.0.0.1:8000/storage/admin_profile_images/${admin.propic}`} alt="Admin avatar"
                                            className="rounded" style={{ width: "150px" }} />
                                        <h5 className="my-3">{admin.username}</h5>
                                        <p className="text-muted mb-1">admin, Grocery OS</p>
                                        <p className="text-muted mb-4">{admin.address}</p>
                                    </div>
                                </div>
                            </div>


                            <div className="col-8">
                                <div className="card">
                                    <div className="card-body">
                                        <div className="user-details">
                                            <div className="row">
                                                <div className="col">
                                                    <h6 className="mb-2 text-primary">Personal Details</h6>
                                                </div>

                                                <div className="row">
                                                    <div className="col-12">
                                                        <label className="text-muted" htmlFor="id">User ID</label>
                                                        <input type="text" className="form-control" value={admin.id} disabled/>
                                                    </div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="userame">Username</label>
                                                        <input type="text" className="form-control" value={admin.username} disabled/>
                                                    </div>
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Name">Name</label>
                                                        <input type="text" className="form-control" value={admin.name} disabled/>
                                                    </div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Email">Email</label>
                                                        <input type="text" className="form-control" value={admin.email} disabled/>
                                                    </div>
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Phone">Phone</label>
                                                        <input type="text" className="form-control" value={admin.phone} disabled/>
                                                    </div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Gender">Gender</label>
                                                        <input type="text" className="form-control" value={admin.gender} disabled/>
                                                    </div>
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Dob">Date Of Birth</label>
                                                        <input type="date" className="form-control" value={admin.dob} disabled/>
                                                    </div>
                                                </div>

                                                <div className="row">
                                                    <div className="col-12">
                                                        <label className="text-muted" htmlFor="Address">Address</label>
                                                        <input type="text" className="form-control" value={admin.address} disabled/>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-12">
                                                        <div className="d-flex justify-content-center mb-2">
                                                            <button type="button" className="btn btn-primary"><Link className='nav-link' to={`/admin/profile/edit/${admin.id}`}>Edit Profile</Link></button>
                                                            <button type="button" className="btn btn-outline-primary ms-1"><Link className='nav-link' to="#">Change Password</Link></button>
                                                        </div>
                                                    </div>
                                                </div>

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

export default Profile