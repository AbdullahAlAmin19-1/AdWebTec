
import { useEffect } from 'react';
import axios from 'axios';
import { useParams } from "react-router-dom"

const DeleteProduct = () => {
    const{id} = useParams();
    useEffect(() => {
        axios.get("http://localhost:8000/api/vendor/deleteProduct/"+id).then(
            (succ) => {
                debugger;
                window.location.href="/Vendor/allProducts";
            },
            (err) => {
                debugger;
            }
        );
    }, []);
}

export default DeleteProduct