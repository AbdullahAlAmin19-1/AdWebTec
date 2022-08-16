import { Link } from "react-router-dom";
import { useState, useEffect } from 'react';
import AxiosConfig from '../Services/AxiosConfig';

const ViewProductBody = ({ value }) => {
    const [product, setProduct] = useState({});
    const [reviews, setReviews] = useState([]);
    const [quantity, setQuantity] = useState("1");

    var p_id = value;
    var c_id = localStorage.getItem('user_id')

    useEffect(() => {
        AxiosConfig.get("products/item/" + p_id).then(
            (res) => {
                setProduct(res.data);
                // debugger;
            },
            (error) => {
                debugger;
            }
        );

        AxiosConfig.get("products/reviews/" + p_id).then(
            (res) => {
                setReviews(res.data);
                console.log(res.data);
                debugger;
            },
            (error) => {
                debugger;
            }
        );

    }, []);


    const addcartHandle = (event) => {
        event.preventDefault();

        const data = { p_id: p_id, c_id: c_id, quantity: quantity };
        console.log(data);
        AxiosConfig.post("customer/addcart", data).
            then((succ) => {
                //setMsg(succ.data.msg);
                alert(succ.data.msg);
                window.location.href = "/customer/cart";

            }, (err) => {
                debugger;
            })
    }

    return (
        <>


            <div className="container-fluid p-3">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Products Info</h3>
                    </div>
                    <div className="card-body">

                        <div className="row m-4">
                            <div className="col-5">
                                <div className="card mb-4">
                                    <div className="card-body text-center">
                                        <img src={`http://127.0.0.1:8000/storage/product_images/${product.thumbnail}`} alt="product image"
                                            className="rounded" style={{ width: "220px" }} />
                                        <h5 className="my-3">{product.name}</h5>
                                        <p className="text-muted mb-1">{product.description}</p>
                                    </div>
                                </div>
                            </div>

                            <div className="col-7 mt-3">
                                <div className="card">
                                    <div className="card-body">
                                        <div className="user-details">
                                            <div className="row">
                                                <div className="col">
                                                    <h6 className="mb-2 text-primary">Product Details</h6>
                                                </div>

                                                <form className="form" onSubmit={addcartHandle}>

                                                    <div className="row">
                                                        <div className="col-12">
                                                            <label className="text-muted" htmlFor="name">Product Name</label>
                                                            <input type="text" className="form-control" value={product.name} />
                                                        </div>
                                                    </div>
                                                    <div className="row">
                                                        <div className="col-6">
                                                            <label className="text-muted" htmlFor="category">Category</label>
                                                            <input type="text" className="form-control" value={product.category} />
                                                        </div>
                                                        <div className="col-6">
                                                            <label className="text-muted" htmlFor="price">Price (Tk)</label>
                                                            <input type="text" className="form-control" value={product.price} />
                                                        </div>
                                                    </div>

                                                    <div className="row">
                                                        <div className="col-12">
                                                            <label className="text-muted" htmlFor="quantity">Select Quantity</label>
                                                            <input type="number" className="form-control" name="quantity" min="1" value={quantity} onChange={(e) => { setQuantity(e.target.value) }} />
                                                        </div>
                                                    </div>

                                                    <div className="row pt-2">
                                                        <div className="d-flex mb-2">
                                                            <button type="submit" className="btn btn-primary">Add To Cart</button>
                                                            <button type="button" className="btn btn-outline-primary ms-1"><Link className='nav-link' to="/">Go Back</Link></button>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div className="container-fluid p-3 text-center">
                <div className="card">
                    <div className="card-header">
                        <h4 className="text-center">Products Reviews</h4>
                    </div>
                    <div className="card-body">
                        <div className="row justify-content-center">

                        {
                                reviews.map((item) =>
                                    <>

                                        <div className="col-6 py-2">
                                            <div className="card">
                                                <div className="card-header bg-primary text-white">
                                                    Review By: {item.customer.username}
                                                </div>
                                                <div className="card-body">
                                                    <h5 className="card-title p-3">{item.message}</h5>
                                                    <p className="card-text">- Customer, Grocery OS</p>
                                                    <sup>Review Date: {item.updated_at}</sup>
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

export default ViewProductBody