import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import { Link } from 'react-router-dom';

const ReviewsBody = () => {

    const [reviews, setReviews] = useState([]);

    useEffect(() => {
        document.title = 'Grocery OS - Reviews';

        AxiosConfig.get("vendor/reviews").then(
            (succ) => {
                debugger;
                setReviews(succ.data.reviews);

                if (succ.data.errmsg) 
                {
                    localStorage.setItem('errmsg', succ.data.errmsg);
                    window.location.href = "/vendor/profile";
                }
            },
            (err) => {
                debugger;
            }

        );
    }, []);
    return (
        <>
            <div className="container-fluid p-4">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Product Reviews</h3>
                    </div>

                    <div className="card-body">

                        <div className="row justify-content-center">
                            {
                                reviews.map((item) =>
                                    <>

                                        <div className="col-4 p-2">
                                            <div className="card">
                                                <div className="card-body">
                                                    <table className="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Review ID</th>
                                                                <td>{item.id}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Product Name</th>
                                                                <td>{item.product.name}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src={`http://127.0.0.1:8000/storage/product_images/${item.product.thumbnail}`} className="img-fluid m-1 rounded mx-auto d-block" alt="Product Image" style={{ width: "150px", height: "150px" }} /></td>
                                                                <td>
                                                                    <textarea className="form-control" name="" id="" cols="10" rows="5" value={item.message}></textarea>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                    </table>

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

export default ReviewsBody