import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import { Link } from 'react-router-dom';
import Table from 'react-bootstrap/Table';


const AllCouponsBody = () => {
  const [allCoupons, setAllCoupons] = useState([]);

  
  const [coupon_id, setCouponID] = useState([]);
  
  const [c_id, setC_id] = useState("");

  const [msg, setMsg] = useState(localStorage.getItem('msg'));
  const [errmsg, setErrMsg] = useState("");
  const [errors, setErrors] = useState([]);

  useEffect(() => {
    document.title='All Coupons';
    AxiosConfig.get("vendor/allCoupons").then((succ) => {
        setAllCoupons(succ.data);
        console.log(succ.data);
        //   debugger;
    }, (err) => {
      alert("Not working");
    //   debugger;
    })
  }, []);

  const remove_coupon = (event) => {
    event.preventDefault();
    AxiosConfig.post("vendor/deleteCoupon/"+coupon_id).then(
      (succ) => {
        setErrors("");
        setMsg(succ.data.msg);
        setErrMsg(succ.data.errmsg);
        debugger;
          // window.location.href="/vendor/allCoupons";
      },
      (err) => {
        setMsg("");
        setErrMsg("");
        debugger;
        setErrors(err.response.data);
      }
  );
}

const assign_coupon = (event) => {
  event.preventDefault();
  const data = {c_id:c_id, co_id:coupon_id};
  AxiosConfig.post("vendor/assignCoupon/", data).then(
    (succ) => {
      setErrors("");
      setMsg(succ.data.msg);
      setErrMsg(succ.data.errmsg);
      debugger;
        // window.location.href="/vendor/allCoupons";
    },
    (err) => {
      localStorage.setItem('msg', '');
      localStorage.setItem('errmsg', '');
      setMsg("");
      setErrMsg("");
      debugger;
      setErrors(err.response.data);
    }
);
}

const remove_msg = () => {
  localStorage.setItem('msg', '');
  localStorage.setItem('errmsg', '');
  setMsg("");
  setErrMsg("");
  window.location.href="/vendor/allCoupons";
}

  return (
    <>

{
                msg ?
                    <div className="container mt-3">
                        <div className="alert alert-success alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove_msg}></button>
                            <strong>Success!</strong> {msg}
                        </div>
                    </div>
                    : ''
            }
{
                errmsg ?
                    <div className="container mt-3">
                        <div className="alert alert-danger alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove_msg}></button>
                            <strong>Failed!</strong> {errmsg}
                        </div>
                    </div>
                    : ''
            }
    <Table striped bordered hover>
    <thead>
      <tr>
        <th>Coupon Id</th>
        <th>Coupon Code</th>
        <th>Discount Amount</th>
        <th>Option</th>
        <th>Assign Coupon</th>
      </tr>
    </thead>
    {allCoupons.map((coupon) =>
    <tbody>
      <tr>
        <td>{coupon.id}</td>
        <td>{coupon.code}</td>
        <td>{coupon.amount}</td>
        <td>
          <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} ><Link className="nav-link" to={`/vendor/editCoupon/${coupon.id}`} >Edit</Link></button>
          <form action="" onSubmit={remove_coupon}>
            <button type="submit" className="btn btn-primary mt-1" style={{ width: "100%" }} onClick={(e) => { setCouponID(coupon.id) }}>Delete</button>
          </form>
        </td>
        <td>
          <form action="" onSubmit={assign_coupon}>
          <input type="number" name="c_id" className="form-control" value={c_id} onChange={(e) => { setC_id(e.target.value) }} />
          <span className="text-danger">{errors.c_id ? errors.c_id[0] : ''}</span>
          <button type="submit" className="btn btn-warning btn ms-2" onClick={(e) => { setCouponID(coupon.id) }}>Assign</button>
          </form>
        </td>
      </tr>
    </tbody>
    )}
  </Table>
  </>
  )
}

export default AllCouponsBody