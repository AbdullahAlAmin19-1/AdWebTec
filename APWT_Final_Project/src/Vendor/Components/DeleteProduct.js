
import { useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import { useParams } from "react-router-dom"

const DeleteProduct = () => {
    document.title='Delete Product';
    const{id} = useParams();
    useEffect(() => {
        AxiosConfig.get("vendor/deleteProduct/"+id).then(
            (succ) => {
                debugger;
                window.location.href="/Vendor/allProducts";
                alert("Product Deleted");
            },
            (err) => {
                debugger;
            }
        );
    }, []);
}


export default DeleteProduct