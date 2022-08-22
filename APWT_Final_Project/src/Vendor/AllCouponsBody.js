import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import { Link } from 'react-router-dom';
import Table from 'react-bootstrap/Table';


const AllCouponsBody = () => {
  const [allCoupons, setAllCouponss] = useState([]);

  const [msg, setMsg] = useState("");
  const [errors, setErrors] = useState([]);

  useEffect(() => {
    document.title='All Coupons';
    AxiosConfig.get("vendor/allCoupons").then((succ) => {
      setAllCouponss(succ.data);
      console.log(succ.data);
      debugger;
    }, (err) => {
      alert("Not working");
      debugger;
    })
  }, []);

  const remove = (id) => {
    AxiosConfig.get("vendor/deleteCoupon/"+id).then(
      (succ) => {
          debugger;
          setMsg(succ.data.msg);
      },
      (err) => {
        debugger;
        setErrors(err.response.data);
      }
  );
}
  return (
    <>
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
      </>  
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
            <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} ><Link className="nav-link" onClick={() => { remove(coupon.id) }} >Delete</Link></button>
            </td>
        <td><input type="text" name="c_id" className="form-control" /><button type="submit" className="btn btn-warning btn ms-2">Assign</button></td>
      </tr>
    </tbody>
    )}
  </Table>
  </>
  )
}

export default AllCouponsBody