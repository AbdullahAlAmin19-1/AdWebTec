import { Link } from 'react-router-dom';
import { useState } from 'react';

const AdHeader = () => {
    const [keyword, setKeyword] = useState("");

  const handleForm = (event) => {
    event.preventDefault();
    if(keyword){
      window.location.href=`/admin/searchproduct/${keyword}`;
    }
  }
    return (
        <>
            <div className="container-fluid">
                <div className="row p-2 pt-3 bg-dark text-center">
                    <div className="col-1 mt-2">
                        <h5><Link className="navbar-brand text-white" to="/">Grocery OS</Link></h5>
                    </div>
                    <div className="col-3">
                        <ul className="nav">
                            <li className="nav-item">
                                <Link className="nav-link" to="/admin/dashboard">Home</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/admin/profile">Profile</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/logout">Logout</Link>
                            </li>
                        </ul>
                    </div>

                    <div className="col-4">
                        <form className="d-flex" onSubmit={handleForm}>
                        <input className="form-control me-2" type="text" value={keyword} placeholder="Search" onChange={(e) => { setKeyword(e.target.value) }} />
                        <button className="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>

                    <div className="col-3">
                        <ul className="nav justify-content-end">
                            <li className="nav-item">
                                <h6 className="text-white mt-2">Welcome! <span>Admin, <span style={{ color: "red" }}><Link style={{textDecoration: 'none'}} to="/admin/profile">Admin</Link></span></span></h6>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div className="col bg-dark p-2">
                    <ul className="nav justify-content-center">
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/approvedeliveryman">Approve Deliveryman</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/viewcoupon">View Coupon</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/addcoupon">Add Coupon</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/approvecoupon">Approve Coupon</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/viewallnotice">View Notices</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/sendnotice">Notice</Link>
                        </li>
                    </ul>
            </div>
        </>
    )
}

export default AdHeader