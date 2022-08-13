import { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import Table from 'react-bootstrap/Table';
import { Button } from 'bootstrap';


const Approvecoupon = () => {
  const [allCoupons, setAllCouponss] = useState([]);
  

  useEffect(() => {
    axios.get("http://localhost:8000/api/admin/viewrequestedcoupon").then((succ) => {
        setAllCouponss(succ.data);
        console.log(succ.data);
    }, (err) => {
      alert("Not working");
    //   debugger;
    })
  }, []);

  const handleRemove = (id)=>{
    // alert(id);
    var co_id = id;
    // const data = {co_id: id};
        axios.get("http://localhost:8000/api/admin/cancelcoupon/"+ co_id).
            then((succ) => {
                //setMsg(succ.data.msg);
                alert(succ.data.msg);
                window.location.reload();

            }, (err) => {
                debugger;
            })
 }
 const handleApprove = (id)=>{
    // alert(id);
    var co_id = id;
        axios.get("http://localhost:8000/api/admin/approvecoupon/"+ co_id).
            then((succ) => {
                //setMsg(succ.data.msg);
                alert(succ.data.msg);
                window.location.reload();

            }, (err) => {
                debugger;
            })
 }

  return (
    <>
    <Table striped bordered hover>
    <thead>
      <tr>
        <th>Coupon Id</th>
        <th>Coupon Code</th>
        <th>Discount Amount</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    {allCoupons.map((coupon) =>
    <tbody>
      <tr>
        <td>{coupon.id}</td>
        <td>{coupon.code}</td>
        <td>{coupon.amount}</td>
        <td>
            <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} onClick={()=>{handleApprove(coupon.id)}}>Approve</button></td><td>
            <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} onClick={()=>{handleRemove(coupon.id)}}>Delete</button>
        </td>
      </tr>
    </tbody>
    )}
  </Table>
  </>
  )
}

export default Approvecoupon