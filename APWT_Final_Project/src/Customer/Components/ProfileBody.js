import { Link } from 'react-router-dom';

const ProfileBody = () => {
    return (
        <>
            <div className="container-fluid">
                <div className="row">
                    <div className="col bg-light p-2">
                        <h4 className='text-center'>Customer Profile Info</h4>
                    </div>
                </div>
                <div className="row mt-2">
                    <div className="col-4">
                        <div className="card mb-4 mt-3">
                            <div className="card-body text-center">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                    className="rounded-circle img-fluid" style={{ width: "150px" }} />
                                <h5 className="my-3">MdRasen</h5>
                                <p className="text-muted mb-1">Customer, Grocery OS</p>
                                <p className="text-muted mb-4">Moghbazar, Dhaka: 1217</p>
                                <div className="d-flex justify-content-center mb-2">
                                    <button type="button" className="btn btn-primary"><Link className='nav-link' to="#">Edit Profile</Link></button>
                                    <button type="button" className="btn btn-outline-primary ms-1"><Link className='nav-link' to="#">Change Password</Link></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="col-8">
                        <div className="card mb-4">
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-3">
                                        <p className="mb-0">User ID</p>
                                    </div>
                                    <div className="col-9">
                                        <p className="text-muted mb-0">01</p>
                                    </div>
                                </div>
                                <hr />
                                <div className="row">
                                    <div className="col-3">
                                        <p class="mb-0">Username</p>
                                    </div>
                                    <div className="col-9">
                                        <p class="text-muted mb-0">MdRasen</p>
                                    </div>
                                </div>
                                <hr />
                                <div className="row">
                                    <div className="col-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div className="col-9">
                                        <p class="text-muted mb-0">Mohammad Rasen</p>
                                    </div>
                                </div>
                                <hr />
                                <div className="row">
                                    <div className="col-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div className="col-9">
                                        <p class="text-muted mb-0">aamin.hossen99@gmail.com</p>
                                    </div>
                                </div>
                                <hr />
                                <div className="row">
                                    <div className="col-3">
                                        <p class="mb-0">Gender</p>
                                    </div>
                                    <div className="col-9">
                                        <p class="text-muted mb-0">Male</p>
                                    </div>
                                </div>
                                <hr />
                                <div className="row">
                                    <div className="col-3">
                                        <p class="mb-0">Date Of Birth</p>
                                    </div>
                                    <div className="col-9">
                                        <p class="text-muted mb-0">11/01/1999</p>
                                    </div>
                                </div>
                                <hr />
                                <div className="row">
                                    <div className="col-3">
                                        <p class="mb-0">Address</p>
                                    </div>
                                    <div className="col-9">
                                        <p class="text-muted mb-0">Moghbazar, Dhaka: 1217</p>
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

export default ProfileBody