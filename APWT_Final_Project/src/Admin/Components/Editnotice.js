import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const Editnotice = ({ n_id }) => {
    const [notices, setNotices] = useState([]);

    const [id, setId] = useState("");
    const [subject, setSubject] = useState("");
    const [message, setMessage] = useState("");
    useEffect(() => {
        document.title='Edit Notice';
        AxiosConfig.get("admin/editnotice/"+n_id).then(
            (res) => {
                setNotices(res.data);
                setId(res.data.id);
                setSubject(res.data.subject);
                setMessage(res.data.message);
                debugger;
            },
            (error) => {
                debugger;
            }

        );
    }, []);
    const handleForm = (event) => {
        event.preventDefault();

        const data = {id: id,subject:subject,message:message};

        AxiosConfig.post("admin/editnoticeupdate", data).
            then((succ) => {
                // window.location.reload();
                window.location.href = `/admin/viewnotice/${id}`;
            }, (err) => {
                debugger;
            })
    }
    return(
        <>
            <section className="bg-dark">
                <center>
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-registration my-4">
                                <div className="row g-0">
                                    <div className="col-xl-12">
                                        <form action="" onSubmit={handleForm}>
                                        <div className="card-body p-md-5 text-black">
                                        <h3 className="mb-2">Edit Notice</h3>
                                            <table>
                                                <tr>
                                                    <th>ID</th>
                                                    {notices.user_type=="Vendor" && <td >{notices.v_id}</td>}
                                                    {notices.user_type=="Customer" && <td >{notices.c_id}</td>}
                                                    
                                                    <input type="hidden" className="form-control form-control-lg" name='id' placeholder="Enter your id" value={id} onChange={(e) => { setId(e.target.value) }}/>
                                                </tr>
                                                <tr>
                                                    <th>To:</th>
                                                    {notices.user_type=="Vendor" && <td >{notices.vendor.name}</td>}
                                                    {notices.user_type=="Customer" && <td >{notices.customer.name}</td>}
                                                </tr>
                                                <tr>
                                                    <th>Email:</th>
                                                    <td>{notices.email}</td>
                                                </tr>
                                                <tr>
                                                    <th>Subject:</th>
                                                    <td><input type="text" name="subject" className="form-control form-control-lg" value={subject} onChange={(e) => { setSubject(e.target.value) }}/></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Message:</th>
                                                    <td><input type="text" name="message" className="form-control form-control-lg" value={message} onChange={(e) => { setMessage(e.target.value) }}/></td>
                                                </tr>
                                            </table>
                                            <br/>
                                            <button type="submit" className="btn btn-primary btn-lg ms-2">Update</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </center>
            </section>
        </>
        
    )
}

export default Editnotice