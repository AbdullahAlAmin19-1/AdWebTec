import { useEffect, useState } from "react";
import AxiosConfig from '../../Public/Services/AxiosConfig';
import Table from 'react-bootstrap/Table';

const Viewcustomer = () => {
  const [msg, setMsg] = useState("");

  const [allCustomer, setAllCustomer] = useState([]);
  

  useEffect(() => {
    document.title='View Customer';
    AxiosConfig.get("admin/viewcustomer").then((succ) => {
        setAllCustomer(succ.data);
        console.log(succ.data);
    }, (err) => {
      alert("Not working");
    //   debugger;
    })
  }, []);

  const handleRemove = (id)=>{
    AxiosConfig.get("admin/removecustomer/"+ id).
            then((succ) => {
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
            <h4 className="text-center">View Customer List</h4>
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
                    <th>Action</th>
                </tr>
            </thead>
    {allCustomer.map((c) =>
    <tbody>
      <tr>
        <td>{c.name}</td>
        <td>{c.username}</td>
        <td>{c.email}</td>
        <td>{c.phone}</td>
        <td>{c.gender}</td>
        <td>{c.dob}</td>
        <td>{c.address}</td>
        <td>
            <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} onClick={()=>{handleRemove(c.id)}}>Delete</button>
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

export default Viewcustomer