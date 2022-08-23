import { Link } from 'react-router-dom';
import { useState } from 'react';

const LogedHeader = () => {
    
    const [keyword, setKeyword] = useState("");
    const handleForm = (event) => {
        event.preventDefault();
        if(keyword){
          window.location.href=`/vendor/searchproduct/${keyword}`;
        }
      }
    return (
        <>
            <div className="container-fluid">
                <div className="row p-2 pt-3 bg-dark text-center">
                    <div className="col-1 mt-2">
                        <h5><Link className="navbar-brand text-white" to="#">Grocery OS</Link></h5>
                    </div>
                    <div className="col-3">
                        <ul className="nav">
                            <li className="nav-item">
                                <Link className="nav-link" to="/vendor/allProducts">Home</Link>
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
                                <h6 className="text-white mt-2">Welcome! <span>{localStorage.getItem('user_type')}, <span style={{ color: "red" }}><Link style={{textDecoration: 'none'}} to="/vendor/profile">{localStorage.getItem('username')}</Link></span></span></h6>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div className="col bg-dark p-2">
                    <ul className="nav justify-content-center">
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/allProducts">Products</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/profile">Manage Account</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/allCoupons">Coupons</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/orders">Orders</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/reviews">Reviews</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/notices">Notices</Link>
                        </li>
                    </ul>
            </div>
        </>
    )
}

export default LogedHeader