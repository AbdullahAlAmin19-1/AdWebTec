import React from 'react'
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import AxiosConfig from '../../Public/Services/AxiosConfig';

const OrderBody = () => {

    const [msg, setMsg] = useState("");

    const [coupon, setCoupon] = useState("");
    const [orders, setOrders] = useState("");
    const [order, setOrder] = useState("");
    const [address, setAddress] = useState("");

    const [confirmed, setConfirmed] = useState("");
    const [invalid, setInvalid] = useState("");
    const [errors, setErrors] = useState([]);

    useEffect(() => {
        document.title = 'Order';

        AxiosConfig.get("vendor/orders" ).then(
            (res) => {
                setOrders(res.data.orders);
                setOrder(res.data.order);
                console.log(res.data);
                debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);

    const handleRemove = (id) => {
        // alert(id);
        const data = { cart_id: id };
        AxiosConfig.post("customer/cartproductremove", data).
            then((succ) => {
                setMsg(succ.data.msg);

            }, (err) => {
                debugger;
            })
    }


    const remove = () => {
        setMsg("");
        window.location.reload();
    }

    const confremove = () => {
        setConfirmed("");
        window.location.href = "/";
    }

    return (
        <>
            {
                msg ?
                    <div className="container mt-3">
                        <div className="alert alert-primary alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                            <strong>Success!</strong> {msg}
                        </div>
                    </div>
                    : ''

            }

            {
                msg ?
                    <div className="container mt-3">
                        <div className="alert alert-primary alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={confremove}></button>
                            <strong>Success!</strong> {msg}
                        </div>
                    </div>
                    : ''

            }

            <div className="container-fluid p-4">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Orders</h3>
                    </div>
                    <div className="card-body">
                        <table className="table table-bordered">
                            <thead>
                                <tr>
                                    <th className="text-center">Order Id</th>
                                    <th className="text-center">Product Id</th>
                                    {/* <th className="text-center">Product Name</th> */}
                                    {/* <th className="text-right">Price (Tk)</th> */}
                                    <th className="text-center">Quantity</th>
                                    {/* <th className="text-center">Total Price (Tk)</th> */}
                                    <th className="text-center">Customer Id</th>
                                    <th className="text-center">Status</th>
                                    <th className="text-center">Payment Method</th>
                                    <th className="text-center">Payment Status</th>
                                    <th className="text-center">Delivery Address</th>
                                    <th className="text-center">Coupon Id</th>
                                    {/* <th className="text-center">Coupon</th> */}
                                </tr>
                            </thead>
                            <tbody>
                            {/* {
                                orders.map((order) =>
                                <> */}
                                    <tr>
                                        <td>{order.id}</td>
                                        <td>{order.p_id}</td>
                                        <td>{order.quantity}</td>
                                        <td>{order.c_id}</td>
                                        <td>{order.status}</td>
                                        <td>{order.payment_method}</td>
                                        <td>{order.payment_status}</td>
                                        <td>{order.delivery_address}</td>
                                        <td>{order.co_id}</td>
                                    </tr>
                                {/* </>
                                )
                            }                */}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </>
    )
}

export default OrderBody




                            

                            // <tr>
                            //     <td>{order.id}</td>
                            //     <td>{order.product.name}</td>
                            //     <td>{order.product.price}</td>
                            //     <td>{order.quantity}</td>
                            //     <td>{order.quantity * order.product.price}</td>
                            //     <td>{order.customer.name}</td>
                            //     <td>{order.status}</td>
                            //     <td>{order.payment_method}</td>
                            //     <td>{order.payment_status}</td>
                            //     <td>{order.delivery_address}</td>            
                            //     <td>{order.co_id}</td>
                            // </tr>

                            // {
                            //     orders.map((order) =>
                            //     <>
                            //         <tr>
                            //             <td>{order.id}</td>
                            //             <td>{order.product.name}</td>
                            //             <td>{order.product.price}</td>
                            //             <td>{order.quantity}</td>
                            //             <td>{order.quantity * order.product.price}</td>
                            //             <td>{order.customer.name}</td>
                            //             <td>{order.status}</td>
                            //             <td>{order.payment_method}</td>
                            //             <td>{order.payment_status}</td>
                            //             <td>{order.delivery_address}</td>
                            //             <td>{order.co_id}</td>
                            //         </tr>
                            //     </>
                            //     )
                            // }   
                            
                            

