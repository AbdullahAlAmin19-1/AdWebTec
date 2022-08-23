import React from 'react'
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import AxiosConfig from '../../Public/Services/AxiosConfig';

const OrderBody = () => {

    const [cartproducts, setCartproducts] = useState([]);
    const [msg, setMsg] = useState("");
    var c_id = localStorage.getItem('user_id');

    const [coupon, setCoupon] = useState("");
    const [payment, setPayment] = useState("Cash On Delivery");
    const [address, setAddress] = useState("");

    const [confirmed, setConfirmed] = useState("");
    const [invalid, setInvalid] = useState("");
    const [errors, setErrors] = useState([]);

    useEffect(() => {
        document.title = 'Grocery OS - Order';

        AxiosConfig.get("customer/viewcart/" + c_id).then(
            (res) => {
                setCartproducts(res.data);
                console.log(res.data);
            },
            (error) => {
                debugger;
            }
        );

        AxiosConfig.get("customer/profileinfo/" + c_id).then(
            (res) => {
                setAddress(res.data.address);
                // debugger;
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

    const QuanDecrement = (id) => {
        // alert(id);
        const data = { cart_id: id };
        AxiosConfig.post("customer/cartquandecrement", data).
            then((succ) => {
                // setMsg(succ.data.msg);
                window.location.reload();

            }, (err) => {
                debugger;
            })
    }

    const QuanIncrement = (id) => {
        // alert(id);
        const data = { cart_id: id };
        AxiosConfig.post("customer/cartquanincrement", data).
            then((succ) => {
                // setMsg(succ.data.msg);
                window.location.reload();

            }, (err) => {
                debugger;
            })
    }

    const remove = () => {
        setMsg("");
        window.location.reload();
    }

    const handleForm = (event) => {
        event.preventDefault();

        const data = { coupon: coupon, payment_option: payment, delivery_address: address };

        AxiosConfig.post("customer/confirmorder", data).
            then((succ) => {
                setConfirmed(succ.data.confirmed);
                setInvalid(succ.data.invalid);

                // debugger;
            }, (err) => {
                // debugger;
                setErrors(err.response.data);
                console.log(err.response.data);
            })
    }

    const confremove = () => {
        setConfirmed("");
        window.location.href = "/customer/dashboard";
    }

    const emptyremove = () => {
        window.location.href = "/customer/cart";
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
                confirmed ?
                    <div className="container mt-3">
                        <div className="alert alert-primary alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={confremove}></button>
                            <strong>Success!</strong> {confirmed}
                        </div>
                    </div>
                    : ''

            }

            {
                invalid ?
                    <div className="container mt-3">
                        <div className="alert alert-danger alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                            <strong>Invalid!</strong> {invalid}
                        </div>
                    </div>
                    : ''

            }


            {
                cartproducts == "" ?

                <div className="container p-3">
                        <div className="alert alert-danger alert-dismissible text-center">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={emptyremove}></button>
                            <strong>Alert!</strong> Your cart table is empty!
                        </div>
                    </div>
                    
                    :

                    <div className="container-fluid p-4">
                    <div className="card">
                        <div className="card-header">
                            <h3 className="text-center">Customer Order</h3>
                        </div>
                        <div className="card-body">
                            <table className="table table-bordered">
                                <thead>
                                    <tr>
                                        <th className="text-center">Product</th>
                                        <th className="text-center">Product Name</th>
                                        <th className="text-center">Product Category</th>
                                        <th className="text-right">Price (Tk)</th>
                                        <th className="text-center">Quantity</th>
                                        <th className="text-center">Total Price (Tk)</th>
                                        <th className="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {
                                        cartproducts.map((item) =>
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
                                                        <button type="button" onClick={() => { QuanDecrement(item.id) }} className="btn btn-sm btn-light"> - </button>
                                                        <button className="btn btn-sm">{item.quantity}</button>
                                                        <button type="button" onClick={() => { QuanIncrement(item.id) }} className="btn btn-sm btn-light"> + </button>
                                                    </td>
                                                    <td>{item.product.price * item.quantity}</td>
                                                    <td><button type="button" className="btn btn-danger" onClick={() => { handleRemove(item.id) }}>Remove</button></td>
                                                </tr>

                                            </>
                                        )
                                    }

                                    <tr className="text-end">
                                        <th colSpan="5">+Delivery Charge (Tk): </th>
                                        <td colSpan="2" className="text-center">60</td>
                                    </tr>
                                </tbody>
                            </table>

                            <form className="form" onSubmit={handleForm}>
                                <table className="table table-bordered">
                                    <tbody>
                                        <tr className="text-end">
                                            <th className="pt-3" style={{ width: "50%" }}>Coupon: </th>
                                            <td className="text-center" style={{ width: "40%" }}>
                                                <input type="text" className="form-control" name="coupon" placeholder="Enter coupon code" value={coupon} onChange={(e) => { setCoupon(e.target.value) }} />
                                            </td>

                                        </tr>
                                        <tr className="text-end">
                                            <th className="pt-3" style={{ width: "50%" }}>Payment Option: </th>
                                            <td className="text-center" style={{ width: "30%" }}>
                                                <select className="form-control" name="payment" value={payment} onChange={(e) => { setPayment(e.target.value) }} >
                                                    <option value="Cash On Delivery">Cash On Delivery</option>
                                                    <option value="Bkash/Nagad">Bkash/Nagad</option>
                                                </select>
                                            </td>

                                        </tr>
                                        <tr className="text-end">
                                            <th className="pt-3" style={{ width: "50%" }}>Delivery Address: </th>
                                            <td className="text-center" style={{ width: "50%" }}>
                                                <input type="text" name="address" className="form-control form-control-md" value={address} onChange={(e) => { setAddress(e.target.value) }} />

                                                <span className="text-danger">{errors.delivery_address ? errors.delivery_address[0] : ''}</span>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div className="text-center">
                                    <button type="button" className="btn btn-outline-primary m-1"><Link className="nav-link" to="/customer/cart">Go Back To Cart</Link></button>
                                    <button type="submit" className="btn btn-primary">Place Order</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                    

            }

        </>
    )
}

export default OrderBody