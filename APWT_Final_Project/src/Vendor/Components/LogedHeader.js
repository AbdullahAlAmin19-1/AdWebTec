import { Link } from 'react-router-dom';

const LogedHeader = () => {
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
                                <Link className="nav-link" to="/vendor/dashboard">Home</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/">Logout</Link>
                            </li>
                        </ul>
                    </div>

                    <div className="col-4">
                        <form className="d-flex">
                            <input className="form-control me-2" type="text" placeholder='Search Product' />
                            <button className="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>

                    <div className="col-3">
                        <ul className="nav justify-content-end">
                            <li className="nav-item">
                                <h6 className="text-white mt-2">Welcome! <span>Vendor, <span style={{ color: "red" }}><Link style={{textDecoration: 'none'}} to="/vendor/profile">Vendor Name</Link></span></span></h6>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div className="col bg-dark p-2">
                    <ul className="nav justify-content-center">
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/allproducts">Products</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/profile">Manage Account</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/allCoupons">Coupons</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="#">Orders</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="#">Reviews</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="#">Notices</Link>
                        </li>
                    </ul>
            </div>
        </>
    )
}

export default LogedHeader