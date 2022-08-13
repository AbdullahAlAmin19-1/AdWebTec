import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import Table from 'react-bootstrap/Table';


const Approvecoupon = () => {
  const [allCoupons, setAllCouponss] = useState([]);
  

  useEffect(() => {
    document.title='Approve Coupon';
    AxiosConfig.get("admin/viewrequestedcoupon").then((succ) => {
        setAllCouponss(succ.data);
        console.log(succ.data);
    }, (err) => {
      alert("Not working");
    //   debugger;
    })
  }, []);

  const handleRemove = (id)=>{
    AxiosConfig.get("admin/cancelcoupon/"+ id).
            then((succ) => {
                //setMsg(succ.data.msg);
                alert(succ.data.msg);
                window.location.reload();

            }, (err) => {
                debugger;
            })
 }
 const handleApprove = (id)=>{
    AxiosConfig.get("admin/approvecoupon/"+ id).
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