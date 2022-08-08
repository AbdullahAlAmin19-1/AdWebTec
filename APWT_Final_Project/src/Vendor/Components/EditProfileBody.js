import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import axios from 'axios';

const EditProfileBody = ({ v_id }) => {
    const [vendor, setVendor] = useState({});

    const[pic,setPic] = useState("");

    const [id, setId] = useState("");
    const [name, setName] = useState("");
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [phone, setPhone] = useState("");
    const [gender, setGender] = useState("");
    const [dob, setDob] = useState("");
    const [address, setAddress] = useState("");
    const [propic, setProPic] = useState("");

    useEffect(() => {
        axios.get("http://localhost:8000/api/vendor/profile/"+v_id).then(
            (succ) => {
                setVendor(succ.data);
                setId(succ.data.id);
                setName(succ.data.name);
                setUsername(succ.data.username);
                setEmail(succ.data.email);
                setPhone(succ.data.phone);
                setGender(succ.data.gender);
                setDob(succ.data.dob);
                setAddress(succ.data.address);
                setProPic(succ.data.propic);
                // debugger;
            },
            (error) => {
                debugger;
            }
        );
    }, []);

    const handleForm = (event) => {
        event.preventDefault();

        const data = { id: id, name: name, username: username, email: email, phone: phone, gender: gender, dob: dob, address: address };

        axios.post("http://localhost:8000/api/vendor/updateprofile", data).
            then((succ) => {
                //setMsg(succ.data.msg);
                alert(succ.data.msg);
                window.location.href="/vendor/profile";
                // debugger;
            }, (err) => {
                debugger;
                // setErrs(err.response.data);
            })
    }

    const handleDp = (event) => {
        event.preventDefault();

        var data = new FormData();
        data.append("file",pic,pic.name);

        axios.post("http://localhost:8000/api/vendor/updatedp", data).
            then((succ) => {
                //setMsg(succ.data.msg);
                alert(succ.data.msg);
                window.location.href="/vendor/profile";
                // debugger;
            }, (err) => {
                debugger;
                // setErrs(err.response.data);
            })
    }

    return (
        <>
            <div className="container-fluid">
                <div className="row m-4">
                    <div className="col-4 mt-5">
                        <div className="card">
                            <div className="card-body">
                                <div className="user-profile">
                                    <div className='text-center'>

                                        <img className="m-2 rounded" src={`http://127.0.0.1:8000/storage/vendor_profile_images/${propic}`}
                                            alt="Vendor Avatar" style={{ width: "150px" }} />
                                    </div>
                                <p className="text-muted mb-1 text-center">Vendor, Grocery OS</p>
                                    <form className="form" onSubmit={handleDp}>
                                        <input type="hidden" name='id' value={id} />
                                        <label htmlFor="pic">Select a picture</label>
                                        <input type="file" name={username} className="form-control mb-1" placeholder="Upload Profile picture" onChange={(e)=>{setPic(e.target.files[0])}} />
                                        <button type="submit" name="submit" className="btn btn-primary">Update</button>
                                    </form>
                                </div>
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
                                        <form className="form" onSubmit={handleForm}>
                                            <div className="row">
                                                <div className="col-12">
                                                    <label htmlFor="id">User ID</label>
                                                    <input type="text" className="form-control" name='id' placeholder="Enter your id" value={id} onChange={(e) => { setId(e.target.value) }} disabled />
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label htmlFor="userame">Username</label>
                                                    <input type="text" className="form-control" name='username' placeholder="Enter username" value={username} onChange={(e) => { setUsername(e.target.value) }} disabled/>
                                                </div>
                                                <div className="col-6">
                                                    <label htmlFor="Name">Name</label>
                                                    <input type="text" className="form-control" name='name' placeholder="Enter name" value={name} onChange={(e) => { setName(e.target.value) }} />
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label htmlFor="Email">Email</label>
                                                    <input type="text" className="form-control" name='email' placeholder="Enter email" value={email} onChange={(e) => { setEmail(e.target.value) }} disabled/>
                                                </div>
                                                <div className="col-6">
                                                    <label htmlFor="Phone">Phone</label>
                                                    <input type="text" className="form-control" name='phone' placeholder="Enter phone" value={phone} onChange={(e) => { setPhone(e.target.value) }} />
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label htmlFor="Gender">Gender</label>
                                                    <input type="text" className="form-control" name='gender' placeholder="Enter gender" value={gender} onChange={(e) => { setGender(e.target.value) }} />
                                                </div>
                                                <div className="col-6">
                                                    <label htmlFor="Dob">Date Of Birth</label>
                                                    <input type="date" className="form-control" name='dob' placeholder="Enter date of birth" value={dob} onChange={(e) => { setDob(e.target.value) }} />
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-12">
                                                    <label htmlFor="Address">Address</label>
                                                    <input type="text" className="form-control" name='address' placeholder="Enter address" value={address} onChange={(e) => { setAddress(e.target.value) }} />
                                                </div>
                                            </div>
                                            <div className="row pt-2">
                                                <div className="d-flex mb-2">
                                                    <button type="submit" className="btn btn-primary">Update</button>
                                                    <button type="button" className="btn btn-outline-primary ms-1"><Link className='nav-link' to="/vendor/profile">Cancel</Link></button>
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
        </>
    )
}

export default EditProfileBody