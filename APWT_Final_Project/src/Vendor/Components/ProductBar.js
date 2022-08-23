import { Link } from 'react-router-dom';

const ProductBar = () => {
    return (
        <>
            <div className="col bg-dark p-2">
                <ul className="nav justify-content-center">
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/allProducts">Products</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/addProduct">Add Product</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/vendor/productChartData">Product Amount</Link>
                        </li>
                </ul>
            </div>
        </>
    )
}

export default ProductBar