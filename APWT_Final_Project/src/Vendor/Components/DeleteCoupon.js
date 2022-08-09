
import { useEffect } from 'react';
import { useParams } from "react-router-dom"
import AxiosConfig from '../../Public/Services/AxiosConfig';

const DeleteCoupon = () => {
    document.title='Delete Coupon';
    const{id} = useParams();
    useEffect(() => {
        AxiosConfig.get("vendor/deleteCoupon/"+id).then(
            (succ) => {
                debugger;
                window.location.href="/Vendor/allCoupons";
                alert("Coupon Deleted");
            },
            (err) => {
                debugger;
            }
        );
    }, []);
}

export default DeleteCoupon