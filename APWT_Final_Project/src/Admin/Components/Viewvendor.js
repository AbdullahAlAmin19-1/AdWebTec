import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const Viewvendor = () => {
    const [vendor, setVendor] = useState({});

    useEffect(() => {
        document.title='View Vendor'; //Setting dummy value
        var $v_id = 1;
        AxiosConfig.get("admin/viewvendor/"+$v_id).then(
            (res) => {
                setVendor(res.data);
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
                        <h3 className="text-center">Vendor Profile</h3>
                    </div>
                    <div className="card-body">

                        <div className="row">
                            <div className="col-4">
                                <div className="card mb-4 mt-1">
                                    <div className="card-body text-center">
                                        <img src={`http://127.0.0.1:8000/storage/vendor_profile_images/${vendor.propic}`} alt="Vendor Avatar"
                                            className="rounded" style={{ width: "150px" }} />
                                        <h5 className="my-3">{vendor.username}</h5>
                                        <p className="text-muted mb-1">vendor, Grocery OS</p>
                                        <p className="text-muted mb-4">{vendor.address}</p>
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
                                                        <input type="text" className="form-control" value={vendor.id} disabled/>
                                                    </div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="userame">Username</label>
                                                        <input type="text" className="form-control" value={vendor.username} disabled/>
                                                    </div>
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Name">Name</label>
                                                        <input type="text" className="form-control" value={vendor.name} disabled/>
                                                    </div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Email">Email</label>
                                                        <input type="text" className="form-control" value={vendor.email} disabled/>
                                                    </div>
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Phone">Phone</label>
                                                        <input type="text" className="form-control" value={vendor.phone} disabled/>
                                                    </div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Gender">Gender</label>
                                                        <input type="text" className="form-control" value={vendor.gender} disabled/>
                                                    </div>
                                                    <div className="col-6">
                                                        <label className="text-muted" htmlFor="Dob">Date Of Birth</label>
                                                        <input type="date" className="form-control" value={vendor.dob} disabled/>
                                                    </div>
                                                </div>

                                                <div className="row">
                                                    <div className="col-12">
                                                        <label className="text-muted" htmlFor="Address">Address</label>
                                                        <input type="text" className="form-control" value={vendor.address} disabled/>
                                                        <br/>
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

export default Viewvendor