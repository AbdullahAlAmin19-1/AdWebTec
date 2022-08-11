import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import axios from 'axios';
import Table from 'react-bootstrap/Table';

const Viewnotice = () => {
    const [notices, setNotices] = useState([]);
    // const[cl, setCl]=useState();
    useEffect(() => {
        axios.get("http://localhost:8000/api/admin/viewnotice").then(
            (res) => {
                setNotices(res.data);
                console.log(res.data);
                // cl == res.data.user_type;
                debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);

    return(
        <>
        
    <Table striped bordered hover>
    <thead>
      <tr>
        <th>Notice Id</th>
        <th>User Type</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
      </tr>
    </thead>
    {notices.map((not) =>
    <tbody>
      <tr>
        <td>{not.id}</td>
        <td>{not.user_type}</td>
        
        {/* {not.v_id != null && <td>{not.vendor.name}</td>}
        {not.c_id != null && <td>{not.customer.name}</td>} */}
        <td>{not.email}</td>
        <td>{not.subject}</td>
        <td>{not.message}</td>
      </tr>
    </tbody>
    )}
  </Table>
  </>
        
    )
}

export default Viewnotice