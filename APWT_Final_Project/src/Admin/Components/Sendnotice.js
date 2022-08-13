import { useState } from 'react';
import axios from 'axios';

const Sendnotice = () => {
    const [user, setUser] = useState("");
    const [email, setEmail] = useState("");
    const [subject, setSubject] = useState("");
    const [message, setMessage] = useState("");

    const handleForm = (event) => {
        event.preventDefault();
        const data={user_type:user,email:email,subject:subject,message:message};
        // alert(data.name);
        axios.post("http://localhost:8000/api/admin/sendnoticeupdate",data).
        then((succ)=>{
            //setMsg(succ.data.msg);
            debugger;
            alert("Ok");
            window.location.href="/admin/sendnotice";
        },(err)=>{
            debugger;
            // setErrs(c);
        })
    }
    
    return (
        <>
            <section className="bg-dark">
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-registration my-4">
                                <div className="row g-0">
                                    <div className="col-xl-12">
                                        <form action="" onSubmit={handleForm}>
                                        <div className="card-body p-md-5 text-black">
                                            <h3 className="mb-5 text-uppercase">Send Mail</h3>

                                            <div className="row">
                                            <div className="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                            <h6 className="mb-0 me-4">Send Notice To: </h6>

                                            <div className="form-check form-check-inline mb-0">
                                                <input type="hidden" name="a_id" value="1"/>
                                                <input className="form-check-input" type="radio" name="user_type"
                                                    value="Vendor" onClick={(e) => { setUser(e.target.value) }}/>
                                                <label className="form-check-label" for="vendor">Vendor</label>
                                            </div>

                                            <div className="form-check form-check-inline mb-0">
                                                <input className="form-check-input" type="radio" name="user_type"
                                                    value="Customer" onClick={(e) => { setUser(e.target.value) }}/>
                                                <label className="form-check-label" for="customer">Customer</label>
                                            </div>

                                            </div>
                                                <div className="form-outline">
                                                    <label className="form-label" for="email">Email</label>
                                                    <input type="email" name="email" className="form-control form-control-lg" value={email} onChange={(e) => { setEmail(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                    <label className="form-label" for="subject">Subject</label>
                                                    <input type="text" name="subject" className="form-control form-control-lg" value={subject} onChange={(e) => { setSubject(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                    <label className="form-label" for="message">Message</label>
                                                    <textarea type="text" name="message" className="form-control form-control-lg" value={message} onChange={(e) => { setMessage(e.target.value) }}/>
                                                </div>
                                        
                                            <div className="d-flex justify-content-end pt-1">
                                                <button type="submit" className="btn btn-warning btn-lg ms-2">Send</button>
                                            </div>
                                        </div>
                                        </div>
                                        </form>
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


export default Sendnotice