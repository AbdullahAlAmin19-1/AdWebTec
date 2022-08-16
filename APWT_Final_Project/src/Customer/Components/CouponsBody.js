import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const CouponsBody = () => {

    const [coupons, setCoupons] = useState([]);
    var c_id = localStorage.getItem('user_id');

    useEffect(() => {
        document.title = 'Grocery OS - Coupons';

        AxiosConfig.get("customer/coupons/" + c_id).then(
            (res) => {
                setCoupons(res.data);
                // console.log(res.data);

                if (res.data.msg == "NOcoupon!") {
                    window.location.href = "/customer/profileinfo";
                }
                // debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);

    return (
        <>
            <div className="container-fluid p-4 text-center">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Customer Coupons</h3>
                    </div>
                    <div className="card-body">

                        <div className="row justify-content-center">

                            {
                                coupons.map((item) =>
                                    <>
                                        <div className="col-4 p-2">
                                            <div className="card">
                                                <div className="card-header bg-primary text-white">
                                                    Coupon ID: {item.id}
                                                </div>
                                                <div className="card-body">
                                                    <h5 className="card-title">{item.coupon.code}</h5>
                                                    <p className="card-text">Discount Amount(Tk): {item.coupon.amount}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </>
                                )
                            }

                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export default CouponsBody