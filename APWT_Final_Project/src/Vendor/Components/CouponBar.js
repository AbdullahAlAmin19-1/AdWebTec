import { Link } from 'react-router-dom';

const CouponBar = () => {
    return (
        <>
            <div className="col bg-dark p-2">
                <ul className="nav justify-content-center">
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/allCoupons">Coupons</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/addCoupon">Add Coupon</Link>
                        </li>
                </ul>
            </div>
        </>
    )
}

export default CouponBar