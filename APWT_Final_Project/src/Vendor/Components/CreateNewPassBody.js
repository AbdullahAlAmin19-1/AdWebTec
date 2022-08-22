import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const CreateNewPassBody = () => {
    const [user, setUser] = useState(localStorage.getItem('user_type'));
    const [email, setEmail] = useState(localStorage.getItem('email'));
    const [new_pass, setNew_pass] = useState("");
    const [conf_new_pass, setConfirm_pass] = useState("");

    const [msg, setMsg] = useState(localStorage.getItem('msg'));
    const [errmsg, setErrMsg] = useState("");
    const [errors, setErrors] = useState([]);
    
    useEffect(() => {
        document.title='Create New Password';
        AxiosConfig.post("vendor/createNewPass").
        then((succ)=>{
            debugger;
        },(err)=>{
            debugger;
        })
      }, []);

    const handleForm = (event) => {
        event.preventDefault();
        const data = { user_type: user, email: email, new_pass: new_pass, conf_new_pass: conf_new_pass };
        // console.log(data);
        AxiosConfig.post("vendor/createNewPass", data).
            then((succ) => {
                setErrors("");
                setErrMsg(succ.data.errmsg);
                if(succ.data.msg)
                {
                    debugger;
                    localStorage.setItem('msg', succ.data.msg);
                    window.location.href = "/vendor/profile";
                }
                debugger;
            }, (err) => {
                setMsg("");
                setErrMsg("");
                debugger;
                setErrors(err.response.data);
                // console.log(err.response.data);
            })
    }

    const remove = () => {
        localStorage.setItem('msg', '');
        localStorage.setItem('errmsg', '');
        setMsg("");
        setErrMsg("");
    }

    return (
        <>
            {
                msg ?
                    <div className="container mt-3">
                        <div className="alert alert-success alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                            <strong>Success!</strong> {msg}
                        </div>
                    </div>
                    : ''
            }
            {
                errmsg ?
                    <div className="container mt-3">
                        <div className="alert alert-danger alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
                            <strong>Failed!</strong> {errmsg}
                        </div>
                    </div>
                    : ''
            }
            <section className="bg-dark">
                <div className="container-fluid">
                    <div className="row px-5 py-4">
                        <div className="col-6">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                alt="Sample photo" className="img-fluid" />
                        </div>
                        <div className="col-6 bg-white" style={{ paddingTop: "130px" }}>
                            <form action="" onSubmit={handleForm}>
                                <div className="card-body p-md-5 text-black">
                                    <h3 className="mb-5 text-uppercase">Enter New Password</h3>

                                    <div className="row">
                                        <div className="col-12">
                                            <label htmlFor="userame">New Password</label>
                                            <input type="password" className="form-control" name='new_pass' placeholder="Enter new password" value={new_pass} onChange={(e) => { setNew_pass(e.target.value) }} />
                                            <span className="text-danger">{errors.new_pass ? errors.new_pass[0] : ''}</span>
                                        </div>

                                        <div className="col-12">
                                            <label htmlFor="Name">Confirm New Password</label>
                                            <input type="password" className="form-control" name='conf_new_pass' placeholder="Retype new password" value={conf_new_pass} onChange={(e) => { setConfirm_pass(e.target.value) }} />
                                            <span className="text-danger">{errors.conf_new_pass ? errors.conf_new_pass[0] : ''}</span>
                                        </div>
                                        
                                    </div>
                                    <div className="d-flex justify-content-end pt-1">
                                        
                                        <button type="submit" className="btn btn-warning btn-lg ms-2">Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default CreateNewPassBody