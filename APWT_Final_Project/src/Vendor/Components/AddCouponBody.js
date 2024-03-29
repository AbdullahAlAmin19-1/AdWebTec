import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const AddCouponBody = () => {
    const [codetype, setCodetype] = useState("");
    const [code, setCode] = useState("");
    const [amount, setAmount] = useState("");

    const [msg, setMsg] = useState("");
    const [errors, setErrors] = useState([]);

    const handleForm = (event) => {
        event.preventDefault();
        const data = { codetype: codetype, code: code, amount: amount };
        // alert(data.name);
        AxiosConfig.post("vendor/addCoupon", data).
            then((succ) => {
                setErrors('');
                setMsg(succ.data.msg);
                debugger;
                // alert("Coupon Created");
                // window.location.href="/vendor/allCoupons";
            }, (err) => {
                debugger;
                setMsg('');
                setErrors(err.response.data);
            })
    }
    useEffect(() => {
        document.title = 'Add Coupon';
        AxiosConfig.post("vendor/addCoupon").
            then((succ) => {
                debugger;
            }, (err) => {
                debugger;
            })
    }, []);


    const remove = () => {
        localStorage.setItem('msg', '');
        localStorage.setItem('errmsg', '');
        setMsg("");
        window.location.href = "/vendor/allCoupons";
    }

    return (
        <>
            {
                msg ?
                    <div className="container mt-3">
                        <div className="alert alert-success alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                            <strong>Success!</strong> {msg}
                        </div>
                    </div>
                    : ''
            }
            <section className="bg-dark">
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-addProduct my-4">
                                <div className="row g-0">
                                    <div className="col-xl-6 d-none d-xl-block">
                                        {/* <img src={`http://127.0.0.1:8000/storage/images/Coupon.png`}
                                            alt="Sample photo" className="img-fluid"
                                            style={{ bordertopleftradius: ".25rem", borderbottomleftradius: ".25rem;" }} /> */}

                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                            alt="Sample photo" className="img-fluid"
                                            style={{ bordertopleftradius: ".25rem", borderbottomleftradius: ".25rem;" }} />
                                    </div>
                                    <div className="col-xl-6" style={{ paddingTop: "150px" }}>
                                        <form action="" onSubmit={handleForm}>
                                            <div className="card-body p-md-5 text-black">
                                                <h3 className="mb-5 text-uppercase">Add Coupon</h3>

                                                <div className="row">
                                                    <div className="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                                        <h6 className="mb-0 me-4">Code Generate: </h6>

                                                        <div className="form-check form-check-inline mb-0">
                                                            <input className="form-check-input" type="radio" name="codetype"
                                                                id="auto" value="auto" onClick={(e) => { setCodetype(e.target.value) }} />
                                                            <label className="form-check-label" for="auto">Auto</label>
                                                        </div>

                                                        <div className="form-check form-check-inline mb-0">
                                                            <input className="form-check-input" type="radio" name="codetype"
                                                                id="manual" value="manual" onClick={(e) => { setCodetype(e.target.value) }} />
                                                            <label className="form-check-label" for="manual">Manual</label>
                                                        </div>
                                                        <span className="text-danger">{errors.codetype ? errors.codetype[0] : ''}</span>
                                                    </div>
                                                    <div className="form-outline">
                                                        <label className="form-label" for="code">Code Digit(Auto) / Code(Manual)</label>
                                                        <input type="text" name="code" className="form-control form-control-lg" value={code} onChange={(e) => { setCode(e.target.value) }} />
                                                        <span className="text-danger">{errors.code ? errors.code[0] : ''}</span>
                                                    </div>
                                                    <div className="form-outline">
                                                        <label className="form-label" for="amount">Amount</label>
                                                        <input type="number" name="amount" className="form-control form-control-lg" value={amount} onChange={(e) => { setAmount(e.target.value) }} />
                                                        <span className="text-danger">{errors.amount ? errors.amount[0] : ''}</span>
                                                    </div>
                                                </div>
                                                <div className="d-flex justify-content-end pt-1">
                                                    <button type="submit" className="btn btn-warning btn-lg ms-2">Create</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default AddCouponBody