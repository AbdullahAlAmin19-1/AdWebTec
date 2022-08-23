import { useEffect, useState } from "react";
import AxiosConfig from '../../Public/Services/AxiosConfig';
import Table from 'react-bootstrap/Table';

const Viewdeliveryman = () => {
  const [msg, setMsg] = useState("");

  const [allDeliveryman, setAllDeliveryman] = useState([]);
  

  useEffect(() => {
    document.title='View Deliveryman';
    AxiosConfig.get("admin/viewdeliveryman").then((succ) => {
        setAllDeliveryman(succ.data);
        console.log(succ.data);
    }, (err) => {
      debugger;
    })
  }, []);

  const handleRemove = (id)=>{
    AxiosConfig.get("admin/removedeliveryman/"+ id).
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
            <h4 className="text-center">View Deliveryman List</h4>
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
    {allDeliveryman.map((d) =>
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

export default Viewdeliveryman