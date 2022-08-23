import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import AxiosConfig from '../../Public/Services/AxiosConfig';

const ViewOrderBody = () => {

    const [orders, setOrders] = useState([]);
    const [dorders, setDorders] = useState([]);
    const [paymoney, setPaymoney] = useState("");
    const [coupon_dis, setCoupon_dis] = useState("");
    //   const [msg, setMsg] = useState("");

    useEffect(() => {
        document.title = 'Grocery OS - Orders';

        AxiosConfig.get("customer/vieworder").then(
            (res) => {
                setOrders(res.data.orders);
                setDorders(res.data.dorders);
                setPaymoney(res.data.pay_money);
                setCoupon_dis(res.data.coupon_dis);

                if (res.data.msg == "NOorder!") {

                    localStorage.setItem('noorder_msg', "You do not have any order, Order first!");
                    window.location.href = "/customer/cart";
                }

            },
            (error) => {
                debugger;
            }

        );
    }, []);

    return (
        <>

            <div className="container-fluid p-4">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Customer Orders</h3>
                    </div>
                    <div className="card-body">
                        <table className="table table-bordered">
                            <thead>
                                <tr>
                                    <th className="text-center h4" colSpan="9">Customer - Current Orders</th>
                                </tr>
                                <tr>
                                    <th className="text-center">Product</th>
                                    <th className="text-center">Product Name</th>
                                    <th className="text-center">Product Category</th>
                                    <th className="text-right">Price (Tk)</th>
                                    <th className="text-center">Quantity</th>
                                    <th className="text-center">Total Price (Tk)</th>
                                    <th className="text-center">Order Status</th>
                                    <th className="text-center">Payment Method</th>
                                    <th className="text-center">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                {
                                    orders.map((item) =>
                                        <>

                                            <tr className="text-center">
                                                <td className="p-1">
                                                    <img src={`http://127.0.0.1:8000/storage/product_images/${item.product.thumbnail}`} alt="Product Image"
                                                        style={{ width: "50px" }} />
                                                </td>
                                                <td>{item.product.name}</td>
                                                <td>{item.product.category}</td>
                                                <td>{item.product.price}</td>
                                                <td>
                                                    <button className="btn btn-sm">{item.quantity}</button>
                                                </td>
                                                <td>{item.product.price * item.quantity}</td>
                                                <td>{item.status}</td>
                                                <td>{item.payment_method}</td>
                                                <td>{item.payment_status}</td>
                                            </tr>
                                        </>
                                    )
                                }

                                <tr className="text-end">
                                    <th colSpan="5">Total Price (Tk): </th>
                                    <td colSpan="5" className="text-start">{paymoney} Taka</td>
                                </tr>

                                <tr className="text-end">
                                    <th colSpan="5">Delivery Charge (Tk): </th>
                                    <td colSpan="5" className="text-start">60 Taka</td>
                                </tr>

                                <tr className="text-end">
                                    <th colSpan="5">Coupon Discount (Tk): </th>
                                    <td colSpan="5" className="text-start">{coupon_dis} Taka</td>
                                </tr>

                                <br />

                                <tr className="text-center">
                                    <th colSpan="9">Delivery Details</th>
                                </tr>

                                <tr className="text-center">
                                    <td colSpan="9"><b>Delivery Date:</b> Within 3-5 Days | <b>DeliveryMan:</b></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div className="card-body">
                        <table className="table table-bordered">
                            <thead>
                                <tr>
                                    <th className="text-center h4" colSpan="9">Customer - Previous Orders</th>
                                </tr>
                                <tr>
                                    <th className="text-center">Product</th>
                                    <th className="text-center">Product Name</th>
                                    <th className="text-center">Product Category</th>
                                    <th className="text-right">Price (Tk)</th>
                                    <th className="text-center">Quantity</th>
                                    <th className="text-center">Total Price (Tk)</th>
                                    <th className="text-center">Order Status</th>
                                    <th className="text-center">Payment Method</th>
                                    <th className="text-center">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                {
                                    dorders.map((item) =>
                                        <>

                                            <tr className="text-center">
                                                <td className="p-1">
                                                    <img src={`http://127.0.0.1:8000/storage/product_images/${item.product.thumbnail}`} alt="Product Image"
                                                        style={{ width: "50px" }} />
                                                </td>
                                                <td>{item.product.name}</td>
                                                <td>{item.product.category}</td>
                                                <td>{item.product.price}</td>
                                                <td>
                                                    <button className="btn btn-sm">{item.quantity}</button>
                                                </td>
                                                <td>{item.product.price * item.quantity}</td>
                                                <td>{item.status}</td>
                                                <td>{item.payment_method}</td>
                                                <td>{item.payment_status}</td>
                                            </tr>
                                        </>
                                    )
                                }

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </>
    )
}

export default ViewOrderBody