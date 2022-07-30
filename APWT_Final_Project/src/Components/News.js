// import {useState} from 'react';
// import axios from 'axios';

// const Form =()=>{
//     const [title,setTitle] = useState("");
//     const [description,setDescription] = useState("");
//     const [postDate,setPostDate] = useState("");
//     const [errs,setErrs] = useState({});
//     const [msg,setMsg] = useState("");
//     const handleSubmit=(event)=>{
//         event.preventDefault();
//         const data={title:title,description:description,postDate:postDate};
//         axios.post("http://localhost:8000/api/news/create",data).then((succ)=>{
//             setMsg(succ.data.msg);
//             // window.location.href="/list";
//         },(err)=>{
//             // debugger;
//             setErrs(err.response.data);
//         })
//     }
//     return(
//         <form onSubmit={handleSubmit}>
//             <h1>{msg}</h1>
//             Name:<input value={title} onChange={(e)=>{setTitle(e.target.value)}} type="text"/><span>{errs.title? errs.title[0]:''}</span><br/>
//             Dob: <input value={description} onChange={(e)=>{setDescription(e.target.value)}} type="text"/><span>{errs.description? errs.description[0]:''}</span><br/>
//             Cgpa: <input value={postDate} onChange={(e)=>{setPostDate(e.target.value)}} type="text"/><span>{errs.postDate? errs.postDate[0]:''}</span><br/>
//             <input type="submit" value="Create"/> 
//         </form>
//     )
// }
// export default Form;

import { useState } from "react";
import axios from "axios";

const CreateStudent=()=>{
    const [name,setName] = useState("");
    const [dob,setDob] = useState("");
    const [cgpa,setCgpa] = useState("");
    const [errs,setErrs] = useState({});
    const [msg,setMsg] = useState("");
    const handleSubmit=(event)=>{
        event.preventDefault();
        const data={name:name,dob:dob,cgpa:cgpa};
        axios.post("http://localhost:8000/api/news/create",data).
        then((succ)=>{
            //setMsg(succ.data.msg);
            window.location.href="/list";
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
export default CreateStudent;