import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const Viewnotice = ({ n_id }) => {
    const [notices, setNotices] = useState([]);
    // const[cl, setCl]=useState();
    useEffect(() => {
      document.title='View Notice';
      AxiosConfig.get("admin/viewnotice/"+n_id).then(
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
        <section className="bg-dark">
            
        <div className="container py-1">
            
        <div className="card card-registration my-6">
                        <div className="col">
                                <div className="row g-0">
                                    <div className="col-xl-12">
                                        <div className="card-body p-md-5 text-black">
    <center>
    <table>
                <tr>
                    <th >Date And Time:</th>
                    <td >{notices.updated_at}</td>
                </tr>
                <tr>
                    <th >ID:</th>
                    {notices.user_type=="Vendor" && <td >{notices.v_id}</td>}
                    {notices.user_type=="Customer" && <td >{notices.c_id}</td>}
                </tr>
                <tr>
                    <th >To:</th>
                    {notices.user_type=="Vendor" && <td >{notices.vendor.name}</td>}
                    {notices.user_type=="Customer" && <td >{notices.customer.name}</td>}
                </tr>
                <tr>
                    <th >Email:</th>
                    <td >{notices.email}</td>
                </tr>
                <tr>
                    <th >Subject:</th>
                    <td >{notices.subject}</td>
                </tr>
                <tr>
                    <th >Message:</th>
                    <td >{notices.message}</td>
                </tr>
                <tr><th></th>
                    <td><button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} ><Link className="nav-link" to={`/admin/editnotice/${notices.id}`}>Update Notice</Link></button></td>
                </tr>
  </table>
  </center>
  
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

export default Viewnotice