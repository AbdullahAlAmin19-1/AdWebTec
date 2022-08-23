import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const Editprofile = ({ a_id }) => {
    const [admin, setAdmin] = useState({});

    const [mydp, setMydp] = useState("");

    const [id, setId] = useState("");
    const [name, setName] = useState("");
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [phone, setPhone] = useState("");
    const [gender, setGender] = useState("");
    const [dob, setDob] = useState("");
    const [address, setAddress] = useState("");
    const [propic, setProPic] = useState("");

    const [msg, setMsg] = useState("");
    const [errors, setErrors] = useState([]);

    useEffect(() => {
        document.title='Edit Profile';
        AxiosConfig.get("admin/profile/" + a_id).then(
            (res) => {
                setAdmin(res.data);

                setId(res.data.id);
                setName(res.data.name);
                setUsername(res.data.username);
                setEmail(res.data.email);
                setPhone(res.data.phone);
                setGender(res.data.gender);
                setDob(res.data.dob);
                setAddress(res.data.address);
                setProPic(res.data.propic);
                debugger;
            },
            (error) => {
                debugger;
            }
        );
    }, []);

    const handleForm = (event) => {
        event.preventDefault();

        const data = { id: id, name: name, phone: phone, dob: dob, address: address };

        AxiosConfig.post("admin/updateprofile", data).
            then((succ) => {
                setMsg(succ.data.msg);
                debugger;
            }, (err) => {
                // setErrs(err.response.data);
                setErrors(err.response.data);
            })
    }

    const handleDp = (event) => {
        event.preventDefault();

        var data = new FormData();
        data.append("file", mydp, mydp.name);

        AxiosConfig.post("admin/updatepropic", data).
            then((succ) => {
                //setMsg(succ.data.msg);
                //alert(succ.data.msg);
                window.location.href = "/admin/profile";
            }, (err) => {
                debugger;
                setErrors(err.response.data);
            })
    }

    const remove = () => {
        setMsg("");
        window.location.href = "/admin/profile";
    }


    return (
        <>
        {
                msg ?
                    <div className="container mt-3">
                        <div className="alert alert-primary alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                            <strong>Success!</strong> {msg}
                        </div>
                    </div>
                    : ''
            }
            <div className="container-fluid p-4">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Admin Profile Edit</h3>
                    </div>
                    <div className="card-body">

                        <div className="row">
                            <div className="col-4 mt-5">
                                <div className="card">
                                    <div className="card-body">
                                        <div className="user-profile">
                                            <div className='text-center'>

                                                <img className="m-2 rounded" src={`http://127.0.0.1:8000/storage/admin_profile_images/${propic}`}
                                                    alt="admin avatar" style={{ width: "150px" }} />
                                            </div>
                                            <p className="text-muted mb-1 text-center">Admin, Grocery OS</p>
                                            <form className="form" onSubmit={handleDp}>
                                                <input type="hidden" name='id' value={id} />
                                                <label htmlFor="mydP">Select a picture</label>
                                                <input type="file" name='mydp' className="form-control mb-1" placeholder="Upload a picture" onChange={(e) => { setMydp(e.target.files[0]) }} />
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
                                                            <label htmlFor="Name">Name</label>
                                                            <input type="text" className="form-control" name='name' placeholder="Enter name" value={name} onChange={(e) => { setName(e.target.value) }} />
                                                            <span className="text-danger">{errors.name ? errors.name[0] : ''}</span>
                                                        </div>
                                                        <div className="col-6">
                                                            <label htmlFor="userame">Username</label>
                                                            <input type="text" className="form-control" name='username' placeholder="Enter username" value={username} disabled />
                                                        </div>
                                                    </div>
                                                    <div className="row">
                                                        <div className="col-6">
                                                            <label htmlFor="Phone">Phone</label>
                                                            <input type="text" className="form-control" name='phone' placeholder="Enter phone" value={phone} onChange={(e) => { setPhone(e.target.value) }} />
                                                            <span className="text-danger">{errors.phone ? errors.phone[0] : ''}</span>
                                                        </div>
                                                        <div className="col-6">
                                                            <label htmlFor="Email">Email</label>
                                                            <input type="text" className="form-control" name='email' placeholder="Enter email" value={email} disabled />
                                                        </div>
                                                    </div>
                                                    <div className="row">
                                                        <div className="col-6">
                                                            <label htmlFor="Dob">Date Of Birth</label>
                                                            <input type="date" className="form-control" name='dob' placeholder="Enter date of birth" value={dob} onChange={(e) => { setDob(e.target.value) }} />
                                                            <span className="text-danger">{errors.dob ? errors.dob[0] : ''}</span>
                                                        </div>
                                                        <div className="col-6">
                                                            <label htmlFor="Gender">Gender</label>
                                                            <input type="text" className="form-control" name='gender' placeholder="Enter gender" value={gender} onChange={(e) => { setGender(e.target.value) }} disabled/>
                                                            <span className="text-danger">{errors.gender ? errors.gender[0] : ''}</span>
                                                        </div>
                                                    </div>
                                                    <div className="row">
                                                        <div className="col-12">
                                                            <label htmlFor="Address">Address</label>
                                                            <input type="text" className="form-control" name='address' placeholder="Enter address" value={address} onChange={(e) => { setAddress(e.target.value) }} />
                                                            <span className="text-danger">{errors.address ? errors.address[0] : ''}</span>
                                                        </div>
                                                    </div>
                                                    <div className="row pt-2">
                                                        <div className="d-flex mb-2">
                                                            <button type="submit" className="btn btn-primary">Update</button>
                                                            <button type="button" className="btn btn-outline-primary ms-1"><Link className='nav-link' to="/admin/profile">Cancel</Link></button>
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

export default Editprofile