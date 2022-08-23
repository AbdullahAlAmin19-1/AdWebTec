import { useEffect, useState } from "react";
import AxiosConfig from '../../Public/Services/AxiosConfig';
import Table from 'react-bootstrap/Table';

const Approvedeliveryman = () => {
  const [msg, setMsg] = useState("");

  const [allDeliverymen, setAllDeliverymen] = useState([]);
  

  useEffect(() => {
    document.title='Approve Deliveryman';
    AxiosConfig.get("admin/viewreqdeliveryman").then((succ) => {
        setAllDeliverymen(succ.data);
        console.log(succ.data);
    }, (err) => {
      alert("Not working");
    //   debugger;
    })
  }, []);

  const handleRemove = (id)=>{
    AxiosConfig.get("admin/canceldeliveryman/"+ id).
            then((succ) => {
                setMsg(succ.data.msg);
                window.location.reload();

            }, (err) => {
                debugger;
            })
 }
 const handleApprove = (id)=>{
    AxiosConfig.get("admin/approvedeliveryman/"+ id).
            then((succ) => {
                setMsg(succ.data.msg);
                window.location.reload();

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

      <div className="container-fluid p-4">
        <div className="card">
          <div className="card-header">
            <h4 className="text-center">Requested Deliverymen List</h4>
          </div>
          <div className="card-body">
          <Table striped bordered hover>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
    {allDeliverymen.map((d) =>
    <tbody>
      <tr>
        <td>{d.name}</td>
        <td>{d.username}</td>
        <td>{d.email}</td>
        <td>{d.phone}</td>
        <td>{d.gender}</td>
        <td>{d.dob}</td>
        <td>{d.address}</td>
        <td>
            <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} onClick={()=>{handleApprove(d.id)}}>Approve</button></td><td>
            <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} onClick={()=>{handleRemove(d.id)}}>Delete</button>
        </td>
      </tr>
    </tbody>
    )}
  </Table>

          </div>
        </div>
      </div>
    </>
  )
}

export default Approvedeliveryman