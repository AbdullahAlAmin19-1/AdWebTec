import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import { Link } from 'react-router-dom';

const ReviewsBody = () => {

    const [reviews, setReviews] = useState([]);
    const [previews, setPReviews] = useState([]);
    const [msg, setMsg] = useState("");

    var c_id = localStorage.getItem('user_id');

    useEffect(() => {
        document.title = 'Grocery OS - Reviews';

        AxiosConfig.get("customer/reviews/" + c_id).then(
            (res) => {
                setReviews(res.data.reviews);
                setPReviews(res.data.previews);
                // console.log(res.data.previews);
                if (res.data.msg == "NOreview!") {
                    window.location.href = "/customer/profileinfo";
                }
                debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);

    const handleDelete = (id) => {
        // alert(id);
        const data = { r_id: id };
        AxiosConfig.post("customer/reviewdelete", data).
            then((succ) => {
                //setMsg(succ.data.msg);
                setMsg(succ.data.msg);

            }, (err) => {
                debugger;
            })
    }

    const remove = () => {
        setMsg("");
        window.location.reload();
    }

    return (
        <>
            <div className="container-fluid p-4">
                <div className="card">
                    <div className="card-header">
                        <h3 className="text-center">Customer Reviews</h3>
                    </div>

                    <div className="card-body">

                        <div className="row justify-content-center">
                            <h4 className="text-center">-- Pending Reviews --</h4>

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
                                                                <td colSpan="2"><img src={`http://127.0.0.1:8000/storage/product_images/${item.product.thumbnail}`} className="img-fluid m-1 rounded mx-auto d-block" alt="Product Image" style={{ width: "150px", height: "150px" }} /></td>
                                                            </tr>
                                                            <tr>
                                                                <td colSpan="2">
                                                                    <button type="submit" className="btn btn-primary my-1" style={{ width: "100%" }}><Link to={`/customer/reviewupdate/${item.id}`} className="nav-link" >Update Review</Link></button>
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


                        <div className="row justify-content-center">
                            <h4 className="text-center">-- Previous Reviews --</h4>

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

                            {
                                previews.map((item) =>
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
                                                            <tr>
                                                                <td colSpan="2" className="text-center">
                                                                    <button type="submit" className="btn btn-primary mx-1" style={{ width: "45%" }}> <Link to={`/customer/reviewupdate/${item.id}`} className="nav-link" >Update Review</Link> </button>
                                                                    <button type="button" className="btn btn-danger" onClick={() => { handleDelete(item.id) }} >Delete Review</button>
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