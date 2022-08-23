import { Link } from 'react-router-dom';

const UserBar = () => {
    return (
        <>
            <div className="col bg-dark p-2">
                <ul className="nav justify-content-center">
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/viewvendor">View Vendor</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/viewcustomer">View Customer</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin/viewdeliveryman">View Deliveryman</Link>
                        </li>
                </ul>
            </div>
        </>
    )
}

export default UserBar