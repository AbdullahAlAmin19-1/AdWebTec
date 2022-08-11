import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';

const AddProductBody = () => {
    const [name, setName] = useState("");
    const [category, setCategory] = useState("");
    const [thumbnail, setThumbnail] = useState("");
    const [price, setPrice] = useState("");
    const [stock, setStock] = useState("");
    const [size, setSize] = useState("");
    const [description, setDescription] = useState("");

    const handleForm = (event) => {
        event.preventDefault();
        const data = {name: name, category: category, thumbnail: thumbnail, price: price, stock: stock, size: size, description: description };
        // alert(data.name);
        AxiosConfig.post("vendor/addProduct",data).
        then((succ)=>{
            //setMsg(succ.data.msg);
            alert("Ok");
            window.location.href="/vendor/allProducts";
        },(err)=>{
            debugger;
        })
    }

    useEffect(() => {
        document.title='Add Product';
        AxiosConfig.post("vendor/addCoupon").
        then((succ)=>{
            debugger;
        },(err)=>{
            debugger;
        })
    }, []);

    return (
        <>
            <section className="bg-dark">
                <div className="container py-1">
                    <div className="row d-flex justify-content-center align-items-center">
                        <div className="col">
                            <div className="card card-addProduct my-4">
                                <div className="row g-0">
                                    <div className="col-xl-6 d-none d-xl-block">
                                            <img src={`http://127.0.0.1:8000/storage/images/Product.png`}
                                            alt="Sample photo" className="img-fluid"
                                            style={{ bordertopleftradius: ".25rem", borderbottomleftradius: ".25rem;" }} />
                                    </div>
                                    <div className="col-xl-6">
                                        <form action="" onSubmit={handleForm}>
                                        <div className="card-body p-md-5 text-black">
                                            <h3 className="mb-5 text-uppercase">Add Product</h3>

                                            <div className="row">
                                            <div className="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                            </div>
                                                <div className="col-md-6">
                                                    <div className="form-outline">                                                        
                                                        <label className="form-label" for="name">Name</label>
                                                        <input type="text" name="name" className="form-control form-control-lg" value={name} onChange={(e) => { setName(e.target.value) }} />
                                                    </div>
                                                </div>
                                                <div className="col-md-6">
                                                    <div className="form-outline">
                                                        <label className="form-label" for="username">Category</label>
                                                        <input type="text" name="category" className="form-control form-control-lg" value={category} onChange={(e) => { setCategory(e.target.value) }}/>
                                                        <label className="form-label" for="username">Category</label>
                                                    </div>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="email">Thumbnail</label>
                                                        <input type="file" name="thumbnail" className="form-control form-control-lg" value={thumbnail} onChange={(e) => { setThumbnail(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="price">Price</label>
                                                        <input type="text" name="price" className="form-control form-control-lg" value={price} onChange={(e) => { setPrice(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="stock">Stock</label>
                                                        <input type="text" name="stock" className="form-control form-control-lg" value={stock} onChange={(e) => { setStock(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="size">Size</label>
                                                        <input type="text" name="size" className="form-control form-control-lg" value={size} onChange={(e) => { setSize(e.target.value) }}/>
                                                </div>
                                                <div className="form-outline">
                                                        <label className="form-label" for="description">Description</label>
                                                        <input type="text" name="description" className="form-control form-control-lg" value={description} onChange={(e) => { setDescription(e.target.value) }}/>
                                                </div>
                                            </div>
                                            <div className="d-flex justify-content-end pt-1">
                                                <button type="submit" className="btn btn-warning btn-lg ms-2">Add</button>
                                            </div>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default AddProductBody