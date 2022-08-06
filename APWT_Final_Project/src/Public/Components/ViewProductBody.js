import { Link } from "react-router-dom";
import { useState, useEffect } from 'react';
import axios from 'axios';

const ViewProductBody = ({ value }) => {
    const [product, setProduct] = useState({});
    var p_id = value;

    useEffect(() => {
        axios.get("http://localhost:8000/api/products/item/"+p_id).then(
            (res) => {
                setProduct(res.data);
                // debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);

    return (
        <>
            <div className="container-fluid">
                <div className="row">
                    <div className="col bg-light p-2">
                        <h4 className='text-center'>Product Info</h4>
                    </div>
                </div>
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

                                        <form className="form">

                                        <div className="row">
                                            <div className="col-12">
                                                <label className="text-muted" htmlFor="id">Product Name</label>
                                                <input type="text" className="form-control" value={product.name} />
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-6">
                                                <label className="text-muted" htmlFor="userame">Category</label>
                                                <input type="text" className="form-control" value={product.category} />
                                            </div>
                                            <div className="col-6">
                                                <label className="text-muted" htmlFor="Name">Price (Tk)</label>
                                                <input type="text" className="form-control" value={product.price} />
                                            </div>
                                        </div>

                                        <div className="row">
                                            <div className="col-12">
                                                <label className="text-muted" htmlFor="id">Select Quantity</label>
                                                <input type="number" className="form-control" min="1" value="1" />
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

            <div className="container">
                <div className="row">
                    <div className="col bg-light p-2">
                        <h4 className='text-center'>Product Reviews</h4>
                    </div>
                </div>
                <div className="row">
                    {/* Show review here */}
                </div>
            </div>
        </>
    )
}

export default ViewProductBody