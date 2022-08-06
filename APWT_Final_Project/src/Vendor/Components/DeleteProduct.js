
import { useState, useEffect } from 'react';
import axios from 'axios';

const DeleteProduct = ({p_id}) => {
    useEffect(() => {
        axios.get("http://localhost:8000/api/vendor/deleteProduct"+p_id).then(
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