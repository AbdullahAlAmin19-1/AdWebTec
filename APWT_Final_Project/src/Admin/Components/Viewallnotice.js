import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import Table from 'react-bootstrap/Table';


const Viewallnotice = () => {
    const [notices, setNotices] = useState([]);
    useEffect(() => {
      document.title='View All Notice';
      AxiosConfig.get("admin/viewallnotice").then(
            (res) => {
                setNotices(res.data);
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
      <tr key={not.id}>
        <td>{not.id}</td>
        <td>{not.user_type}</td>
        
        {/* {not.v_id != null && <td>{not.vendor.name}</td>} */}
        {/* {not.c_id != null && <td>{not.customer.name}</td>}  */}
        <td>{not.email}</td>
        <td><Link to={`/admin/viewnotice/${not.id}`}>{not.subject}</Link></td>
        <td>{not.message}</td>
      </tr>
    </tbody>
    )}
  </Table>
  </>
        
    )
}

export default Viewallnotice