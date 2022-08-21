import { Link } from 'react-router-dom';
import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const EditProductBody = ({p_id}) => {
    const [product, setProduct] = useState({});
    
    const[pic,setPic] = useState("");

    const [id, setId] = useState("");
    const [name, setName] = useState("");
    const [category, setCategory] = useState("");
    const [thumbnail, setThumbnail] = useState("");
    const [price, setPrice] = useState("");
    const [stock, setStock] = useState("");
    const [size, setSize] = useState("");
    const [description, setDescription] = useState("");

    const [msg, setMsg] = useState("");
    const [errors, setErrors] = useState([]);
    // alert(id);
    useEffect(() => {
    document.title='Edit Product';
    AxiosConfig.get("vendor/editProduct/"+p_id).then(
            (succ) => {
                setProduct(succ.data);
                setId(succ.data.id);
                setName(succ.data.name);
                setCategory(succ.data.category);
                setThumbnail(succ.data.thumbnail);
                setPrice(succ.data.price);
                setStock(succ.data.stock);
                setSize(succ.data.size);
                setDescription(succ.data.description);
                debugger;
            },
            (err) => {
                debugger;
            }
        );
    }, []);

    const handleForm = (event) => {
        event.preventDefault();

        const data = {id:id, name: name, category: category, price: price, stock: stock, size: size, description: description };

        AxiosConfig.post("vendor/updateProduct", data).
            then((succ) => {
                setMsg(succ.data.msg);
                // alert(succ.data.msg);
                // window.location.href="/vendor/allProducts";
                debugger;
            }, (err) => {
                debugger;
                setErrors(err.response.data);
            })
    }

    const handleThumbnail = (event) => {
        event.preventDefault();

        var data = new FormData();
        data.append("file",pic,pic.name);
        debugger;
        localStorage.setItem('product_id',id);

        AxiosConfig.post("vendor/updateThumbnail", data).
            then((succ) => {
                setMsg(succ.data.msg);
                // alert(succ.data.msg);
                // window.location.href="/vendor/allProducts";
                // debugger;
            }, (err) => {
                debugger;
                setErrors(err.response.data);
            })
    }

    const remove_product = () => {
        AxiosConfig.get("vendor/deleteProduct/"+id).then(
            (succ) => {
                setMsg(succ.data.msg);
                // alert(succ.data.msg);
                // window.location.href="/vendor/allProducts";
                // debugger;
            },
            (err) => {
                debugger;
                setErrors(err.response.data);
            }
        );
    }

    const remove_msg = () => {
        setMsg("");
        window.location.href="/vendor/allProducts";
    }

    return (
        <>
            {
                msg ?
                    <div className="container mt-3">
                        <div className="alert alert-primary alert-dismissible">
                            <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove_msg}></button>
                            <strong>Success!</strong> {msg}
                        </div>
                    </div>
                    : ''
            }
            <div className="container-fluid">
                <div className="row m-4">
                    <div className="col-4 mt-5">
                        <div className="card">
                            <div className="card-body">
                                <div className="user-profile">
                                    <div className='text-center'>

                                        <img className="m-2 rounded" src={`http://127.0.0.1:8000/storage/product_images/${thumbnail}`}
                                            alt="Product Thumbnail" style={{ width: "150px" }} />
                                    </div>
                                <p className="text-muted mb-1 text-center">Products, Grocery OS</p>
                                    <form className="form" onSubmit={handleThumbnail}>
                                        <input type="hidden" name='id' value={id} />
                                        <label htmlFor="pic">Select a picture</label>
                                        <input type="file" name={name} className="form-control mb-1" placeholder="Upload a thumbnail" onChange={(e)=>{setPic(e.target.files[0])}} />
                                        <button type="submit" name="submit" className="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="col-8">
                        <div className="card">
                            <div className="card-body">
                                <div className="user-details">
                                    <div className="row">
                                        <div className="col">
                                            <h6 className="mb-2 text-primary">Product Details</h6>
                                        </div>
                                        <form className="form" onSubmit={handleForm}>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label htmlFor="Name">Name</label>
                                                    <input type="text" className="form-control" name='name' placeholder="Enter name" value={name} onChange={(e) => { setName(e.target.value) }} />
                                                    <span className="text-danger">{errors.name ? errors.name[0] : ''}</span>
                                                </div>
                                                <div className="col-6">
                                                    <label htmlFor="userame">Category</label>
                                                    <input type="text" className="form-control" name='category' placeholder="Enter category" value={category} onChange={(e) => { setCategory(e.target.value) }} />
                                                    <span className="text-danger">{errors.category ? errors.category[0] : ''}</span>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label htmlFor="stock">Stock</label>
                                                    <input type="text" className="form-control" name='stock' placeholder="Enter stock" value={stock} onChange={(e) => { setStock(e.target.value) }} />
                                                    <span className="text-danger">{errors.stock ? errors.stock[0] : ''}</span>
                                                </div>
                                                <div className="col-6">
                                                    <label htmlFor="price">Price</label>
                                                    <input type="text" className="form-control" name='price' placeholder="Enter price" value={price} onChange={(e) => { setPrice(e.target.value) }} />
                                                    <span className="text-danger">{errors.price ? errors.price[0] : ''}</span>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label htmlFor="size">Size</label>
                                                    <input type="text" className="form-control" name='size' placeholder="Enter size" value={size} onChange={(e) => { setSize(e.target.value) }} />
                                                </div>
                                                <div className="col-6">
                                                    <label htmlFor="description">Description</label>
                                                    <input type="text" className="form-control" name='description' placeholder="Enter description" value={description} onChange={(e) => { setDescription(e.target.value) }} />
                                                </div>
                                            </div>
                                            <div className="row pt-2">
                                                <div className="d-flex mb-2">
                                                    <button type="submit" className="btn btn-primary">Update</button>
                                                    <button type="button" className="btn btn-primary ms-1" onClick={remove_product}> Delete</button>
                                                    <button type="button" className="btn btn-outline-primary ms-1"><Link className='nav-link' to="/vendor/allProducts">Cancel</Link></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export default EditProductBody