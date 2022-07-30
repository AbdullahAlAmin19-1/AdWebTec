import {useState} from 'react';
import axios from 'axios';

const VendorList = () => {
    const[vendors,setVendors] = useState([]);
    const loadData=()=>{
        axios.get("http://localhost:8000/api/vendors/user").then((rsp)=>{
            setVendors(rsp.data);
        },(er)=>{
            alert("Not working")
        })
    }
    
  return (
    <>
        <button onClick={loadData}>Load Data</button>
            <ul>
                {
                    vendors.map((st)=>
                    <>
                    <li>{st.name}</li>
                    <li>{st.email}</li>
                    <li>{st.phone}</li>
                    </>
                    )
                }
            </ul>
    </>
  )
}

export default VendorList