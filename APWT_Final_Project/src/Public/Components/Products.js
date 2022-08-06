import { useState, useEffect } from 'react';
import axios from 'axios';

const Products = () => {

  const [allproducts, setAllproducts] = useState({});
  const [quantity, setQuantity] = useState("1");

  useEffect(() => {
    axios.get("http://localhost:8000/api/public/products").then(
      (res) => {
        setAllproducts(res.data);
        console.log(res.data);
        // debugger;
      },
      (error) => {

      })

  }, []);

  return (
    <>

      {/* {
        allproducts.map((p) =>
          <li>{p.name}</li>
        )
      } */}



      {/* <div className="container-fluid p-4 bg-light">
        <h3 className="text-center">Selling Products</h3>
        <div className="row justify-content-center">

          <div className="col-3 p-3">
            <div className="card">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/12.webp"
                className="img-fluid" alt="Laptop" />

              <div className="card-body pb-0">
                <p><a href="#" className="text-dark">Dell Xtreme 270</a></p>
                <p className="small text-muted">Laptops</p>
              </div>
              <hr className="my-0" />
              <div className="card-body pb-0">
                <div className="d-flex justify-content-between">
                  <p className="text-dark">Price</p>
                  <p className="text-dark">120 Taka</p>
                </div>
              </div>
              <hr className="my-0" />
              <div className="card-body">
                <div className="d-flex justify-content-between align-items-center">
                  <form action="">
                    <input type="hidden" name="c_id" value="1" style={{ width: "100%" }} />
                    <label htmlFor="quantity">Quantity</label>
                    <input type="number" name="quantity" min="1" value={quantity} style={{ width: "100%" }} onChange={(e) => { setQuantity(e.target.value) }} />

                    <button type="button" className="btn btn-primary mt-1" style={{ width: "100%" }} >Add to
                      cart</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> */}
    </>
  )
}

export default Products