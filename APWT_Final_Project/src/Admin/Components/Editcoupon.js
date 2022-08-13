import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';


const Editcoupon = ({ co_id }) => {
    const [notices, setNotices] = useState([]);

    const [id, setId] = useState("");
    const [code, setCode] = useState("");
    const [amount, setAmount] = useState("");
    useEffect(() => {
        document.title='Edit Coupon';
        AxiosConfig.get("admin/editcoupon/"+co_id).then(
            (res) => {
                setNotices(res.data);
                setId(res.data.id);
                setCode(res.data.code);
                setAmount(res.data.amount);
                debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);
    const handleForm = (event) => {
        event.preventDefault();

        const data = {id: id, code: code, amount: amount};

        AxiosConfig.post("admin/editcouponupdate", data).
            then((succ) => {
                window.location.href = `/admin/viewcoupon`;
            }, (err) => {
                debugger;
            })
    }
    return(
        <>
            <section className="bg-dark">
                <center>
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-registration my-4">
                                <div className="row g-0">
                                    <div className="col-xl-12">
                                        <form action="" onSubmit={handleForm}>
                                        <div className="card-body p-md-5 text-black">
                                            <h3 className="mb-5 text-uppercase">Edit Coupon</h3>

                                            <div className="row">
                                            <div className="d-md-flex justify-content-start align-items-center mb-4 py-2">
                                            </div>
                                                <div className="form-outline">
                                                        <label className="form-label" htmlFor="id">Coupon Id</label>
                                                        <input type="text" name="id" className="form-control form-control-lg" value={id} disabled/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" htmlFor="code">Code</label>
                                                        <input type="text" name="code" className="form-control form-control-lg" value={code} onChange={(e) => { setCode(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" htmlFor="amount">Amount</label>
                                                        <input type="text" name="price" className="form-control form-control-lg" value={amount} onChange={(e) => { setAmount(e.target.value) }}/>
                                                </div>
                                            </div>
                                            <div className="d-flex justify-content-end pt-1">
                                                <button type="submit" className="btn btn-warning btn-lg ms-2">Update</button>
                                            </div>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </center>
            </section>
        </>
        
    )
}

export default Editcoupon