import { useState, useEffect } from 'react';
import AxiosConfig from '../Services/AxiosConfig';
import { Link } from 'react-router-dom';
const CategoryBody = ({ category }) => {

  const [products, setProducts] = useState([]);

  useEffect(() => {
    // alert(category);
    AxiosConfig.get("public/category/products/" + category).then((rsp) => {
      setProducts(rsp.data);
      console.log(rsp.data);
    }, (er) => {
      debugger;
    })
  }, []);

  return (
    <>

      <div className="container-fluid p-4">
        <div className="card">
          <div className="card-header">
            <h5 className="text-center">Products / Category / {category}</h5>
          </div>
          <div className="card-body">

            <div className="row justify-content-center">

              {
                products.map((item) =>
                  <>

                    <div className="col-3 p-3">
                      <div className="card">
                        <img src={`http://127.0.0.1:8000/storage/product_images/${item.thumbnail}`}
                          className="img-fluid m-5" alt="Product Image" style={{ width: "200px", height: "200px" }} />

                        <div className="card-body pb-0">
                          <p><a href={`/products/item/${item.id}`} className="text-dark">{item.name}</a></p>
                          <p className="small text-muted">{item.category}</p>
                        </div>
                        <hr className="my-0" />
                        <div className="card-body pb-0">
                          <div className="d-flex justify-content-between">
                            <p className="text-dark">Price (Tk)</p>
                            <p className="text-dark">{item.price}</p>
                          </div>
                        </div>
                        <hr className="my-0" />
                        <div className="card-body">
                          <div className="d-flex justify-content-between align-items-center">

                            <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} ><Link className="nav-link" to={`/products/item/${item.id}`} >View Product</Link></button>

                          </div>
                        </div>
                      </div>
                    </div>

                  </>
                )
              }

            </div>

          </div>
        </div>
      </div>

    </>
  )
}

export default CategoryBody