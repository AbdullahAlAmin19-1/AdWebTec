import { useState, useEffect } from 'react';
import axios from 'axios';

const EditCouponBody = ({ co_id }) => {
    var [Coupon, setCoupons] = useState([]);

    const [id, setId] = useState("");
    const [code, setCode] = useState("");
    const [amount, setAmount] = useState("");

  useEffect(() => {
    // document.title='Coupon';
    axios.get("http://localhost:8000/api/vendor/editCoupon/" +co_id).then((succ) => {
        setCoupons(succ.data);

        
        setId(succ.data.id);
        setCode(succ.data.code);
        setAmount(succ.data.amount);
        debugger;
    }, (err) => {
      alert("Not working");
      debugger;
    })
  }, []);

    const handleForm = (event) => {
        event.preventDefault();
        const data = {id: id, code: code, amount: amount};
        // alert(data.name);
        axios.post("http://localhost:8000/api/vendor/updateCoupon",data).
        then((succ)=>{
            // debugger;
            // alert("Ok");
            window.location.href="/vendor/allCoupons";
        },(err)=>{
            // debugger;
        })
    }
    
    return (
        <>
            <section className="bg-dark">
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-addProduct my-4">
                                <div className="row g-0">
                                    <div className="col-xl-6 d-none d-xl-block">
                                            <img src={`http://127.0.0.1:8000/storage/images/Coupon.png`}
                                            alt="Sample photo" className="img-fluid"
                                            style={{ bordertopleftradius: ".25rem", borderbottomleftradius: ".25rem;" }} />
                                    </div>
                                    <div className="col-xl-6">
                                        <form action="" onSubmit={handleForm}>
                                        <div className="card-body p-md-5 text-black">
                                            <h3 className="mb-5 text-uppercase">Edit Coupon</h3>

                                            <div className="row">
                                            <div className="d-md-flex justify-content-start align-items-center mb-4 py-2">
                                            </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="id">Coupon Id</label>
                                                        <input type="text" name="id" className="form-control form-control-lg" value={id} disabled/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="code">Code</label>
                                                        <input type="text" name="code" className="form-control form-control-lg" placeholder="Enter name" value={code} onChange={(e) => { setCode(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="amount">Amount</label>
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
            </section>
        </>
    )
}

export default EditCouponBody