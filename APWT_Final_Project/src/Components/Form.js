import {useState} from 'react';
import axios from 'axios';

const Form =()=>{
    const [name,setName] = useState("");
    const [dob,setDob] = useState("");
    const [cgpa,setCgpa] = useState("");
    const [errs,setErrs] = useState({});
    const [msg,setMsg] = useState("");
    const handleSubmit=(event)=>{
        event.preventDefault();
        const data={name:name,dob:dob,cgpa:cgpa};
        axios.post("http://localhost:8000/api/registration",data).then((succ)=>{
            setMsg(succ.data.msg);
            // window.location.href="/list";
        },(err)=>{
            // debugger;
            setErrs(err.response.data);
        })
    }
    return(
        <form onSubmit={handleSubmit}>
            <h1>{msg}</h1>
            Name:<input value={name} onChange={(e)=>{setName(e.target.value)}} type="text"/><span>{errs.name? errs.name[0]:''}</span><br/>
            Dob: <input value={dob} onChange={(e)=>{setDob(e.target.value)}} type="text"/><br/>
            Cgpa: <input value={cgpa} onChange={(e)=>{setCgpa(e.target.value)}} type="text"/><span>{errs.cgpa? errs.cgpa[0]:''}</span><br/>
            <input type="submit" value="Create"/> 
        </form>
    )
}
export default Form;