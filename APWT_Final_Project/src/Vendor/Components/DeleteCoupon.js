
import { useState, useEffect } from 'react';
import { useParams } from "react-router-dom"
import axios from 'axios';

const DeleteCoupon = () => {
    const{id} = useParams();
    useEffect(() => {
        axios.get("http://localhost:8000/api/vendor/deleteCoupon"+id).then(
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

export default DeleteCoupon