import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import axios from "axios";

const CartBody = () => {

  const [cartproducts, setCartproducts] = useState([]);
  var c_id = 1; //Getting dummy value

  useEffect(() => {

    axios.get("http://localhost:8000/api/customer/viewcart/" + c_id).then(
      (res) => {
        setCartproducts(res.data);
        console.log(res.data);
        // debugger;
      },
      (error) => {
        debugger;
      }

    );
  }, []);

  const handleRemove = (id)=>{
    // alert(id);
    const data = {cart_id: id};
        axios.post("http://localhost:8000/api/customer/cartproductremove", data).
            then((succ) => {
                //setMsg(succ.data.msg);
                alert(succ.data.msg);
                window.location.reload();

            }, (err) => {
                debugger;
            })
}

  return (
    <>
      <div className="container-fluid p-4">
        <div className="card">
          <div className="card-header">
            <h3 className="text-center">Shopping Cart</h3>
          </div>
          <div className="card-body">
            <table className="table table-bordered">
              <thead>
                <tr>
                  <th className="text-center">Product</th>
                  <th className="text-center">Product Name</th>
                  <th className="text-center">Product Category</th>
                  <th className="text-right">Price (Tk)</th>
                  <th className="text-center">Quantity</th>
                  <th className="text-center">Total Price (Tk)</th>
                  <th className="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                {
                  cartproducts.map((item) =>
                    <>

                      <tr className="text-center">
                        <td className="p-1">
                          <img src={`http://127.0.0.1:8000/storage/product_images/${item.product.thumbnail}`} alt="Product Image"
                            style={{ width: "50px" }} />
                        </td>
                        <td>{item.product.name}</td>
                        <td>{item.product.category}</td>
                        <td>{item.product.price}</td>
                        <td>{item.quantity}</td>
                        <td>{item.product.price * item.quantity}</td>
                        {/* <td><button type="button" className="btn btn-danger">
                          <Link className="nav-link" to="#">Remove Product</Link>
                        </button></td> */}
                        <td><button type="button" className="btn btn-danger" onClick={()=>{handleRemove(item.id)}}>Remove</button></td>
                      </tr>

                    </>
                  )
                }

              </tbody>
            </table>

            <div className="text-center">
              <button type="button" className="btn btn-outline-primary m-1"><Link className="nav-link" to="/">Back to shopping</Link></button>
              <button type="button" className="btn btn-primary m-1">Continue To Order</button>
            </div>

          </div>
        </div>
      </div>
    </>
  )
}

export default CartBody