import { Link } from 'react-router-dom';
import { useState, useEffect } from "react";
import AxiosConfig from '../../Public/Services/AxiosConfig'

const CusHeader = () => {
    const [keyword, setKeyword] = useState("");

    useEffect(() => {
        document.title='Grocery OS - Dashboard';
        AxiosConfig.get("customer/viewcart/" + localStorage.getItem('user_id')).then(
            (res) => {
                // Do nothing
            },
            (error) => {
                debugger;
            }

        );
    }, []);

    const handleForm = (event) => {
        event.preventDefault();
        
        if(keyword){
          window.location.href=`/searchproduct/${keyword}`;
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
                                <Link className="nav-link" to="/customer/dashboard">Home</Link>
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
                                <h6 className="text-white mt-2">Welcome! <span>{localStorage.getItem('user_type')}, <span style={{ color: "red" }}><Link style={{ textDecoration: 'none' }} to="/vendor/profile">{localStorage.getItem('username')}</Link></span></span></h6>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div className="col bg-dark p-2">
                <ul className="nav justify-content-center">
                    <li className="nav-item">
                        <Link className="nav-link" to="/customer/profileinfo">Manage Account</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/customer/cart">Cart</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="#">Orders</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/customer/reviews">Reviews</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/customer/coupons">Coupons</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/customer/notices">Notices</Link>
                    </li>
                </ul>
            </div>
        </>
    )
}

export default CusHeader