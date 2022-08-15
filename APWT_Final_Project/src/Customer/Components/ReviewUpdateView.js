import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const ReviewUpdateView = ({ value }) => {

    const [review, setReview] = useState({});
    const [product, setProduct] = useState({});
    const [message, setMessage] = useState("");
    const [msg, setMsg] = useState("");

    var r_id = value;

    useEffect(() => {
        document.title = 'Grocery OS - Update Review';

        AxiosConfig.get("reviewview/" + r_id).then(
            (res) => {
                setReview(res.data);
                setMessage(res.data.message);
                setProduct(res.data.product);
                debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);


    const ReviewUpdate = (event) => {
        event.preventDefault();

        const data = { r_id: r_id, p_id: product.id, r_message: message };
        console.log(data);
        AxiosConfig.post("customer/reviewupdate", data).
            then((succ) => {
                setMsg(succ.data.msg);

            }, (err) => {
                debugger;
            })
    }

    const remove = () => {
        setMsg("");
        window.location.href = "/customer/reviews";
      }

    return (
        <>
            <div className="container-fluid p-4">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Review Update</h3>
                    </div>

                    {
                        msg ?
                            <div className="container mt-3 px-5">
                                <div className="alert alert-primary alert-dismissible">
                                    <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                                    <strong>Success!</strong> {msg}
                                </div>
                            </div>
                            : ''
                    }

                    <div className="card-body">

                        <div className="row justify-content-center">
                            <div className="col-6 p-2">
                                <div className="card">
                                    <div className="card-body">

                                        <table className="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Review ID</th>
                                                    <td>{review.id}</td>
                                                </tr>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <td>{product.name}</td>
                                                </tr>
                                                <tr>
                                                    <th><img src={`http://127.0.0.1:8000/storage/product_images/${product.thumbnail}`} className="img-fluid m-1" alt="Product Image" style={{ width: "150px", height: "150px" }} /></th>
                                                    <td>
                                                        <form onSubmit={ReviewUpdate} className="form">
                                                            <input type="hidden" className="form-control" name="p_id" value={product.id} />

                                                            {/* <textarea className="form-control" name="r_message" cols="4" rows="4" placeholder="Write your review..." value={message} onClick={(e) => { setMessage(e.target.value) }}></textarea> */}

                                                            <label className="text-muted" htmlFor="r_message">Review Message</label>
                                                            <input type="text" className="form-control" name="r_message" min="1" value={message} placeholder="Write your review..." onChange={(e) => { setMessage(e.target.value) }} />

                                                            <button type="submit" className="btn btn-primary my-1" style={{ width: "100%" }}>Update</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </>
    )
}

export default ReviewUpdateView