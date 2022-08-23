import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import AxiosConfig from '../../Public/Services/AxiosConfig';

const CartBody = () => {

  const [cartproducts, setCartproducts] = useState([]);
  const [msg, setMsg] = useState("");

  var c_id = localStorage.getItem('user_id');
  var noorder_msg = localStorage.getItem('noorder_msg');

  useEffect(() => {
    document.title = 'Grocery OS - Cart';

    AxiosConfig.get("customer/viewcart/" + c_id).then(
      (res) => {
        setCartproducts(res.data);
        console.log(res.data);
      },
      (error) => {
        debugger;
      }

    );
  }, []);

  const handleRemove = (id) => {
    // alert(id);
    const data = { cart_id: id };
    AxiosConfig.post("customer/cartproductremove", data).
      then((succ) => {
        setMsg(succ.data.msg);
        // alert(succ.data.msg);
        // window.location.reload();

      }, (err) => {
        debugger;
      })
  }

  const QuanDecrement = (id) => {
    // alert(id);
    const data = { cart_id: id };
    AxiosConfig.post("customer/cartquandecrement", data).
      then((succ) => {
        // setMsg(succ.data.msg);
        window.location.reload();

      }, (err) => {
        debugger;
      })
  }

  const QuanIncrement = (id) => {
    // alert(id);
    const data = { cart_id: id };
    AxiosConfig.post("customer/cartquanincrement", data).
      then((succ) => {
        // setMsg(succ.data.msg);
        window.location.reload();

      }, (err) => {
        debugger;
      })
  }

  const remove = () => {
    setMsg("");
    window.location.reload();
  }

  const emptyremove = () => {
    localStorage.removeItem('noorder_msg', '');
    window.location.reload();
  }

  return (
    <>

      {
        msg ?
          <div className="container mt-3">
            <div className="alert alert-primary alert-dismissible">
              <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
              <strong>Success!</strong> {msg}
            </div>
          </div>
          : ''
      }

      {
        noorder_msg ?
          <div className="container mt-3">
            <div className="alert alert-danger alert-dismissible">
              <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={emptyremove}></button>
              <strong>Alert!</strong> {noorder_msg}
            </div>
          </div>
          : ''
      }

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
                        <td>
                          <button type="button" onClick={() => { QuanDecrement(item.id) }} className="btn btn-sm btn-light"> - </button>
                          <button className="btn btn-sm">{item.quantity}</button>
                          <button type="button" onClick={() => { QuanIncrement(item.id) }} className="btn btn-sm btn-light"> + </button>
                        </td>
                        <td>{item.product.price * item.quantity}</td>
                        <td><button type="button" className="btn btn-danger" onClick={() => { handleRemove(item.id) }}>Remove</button></td>
                      </tr>

                    </>
                  )
                }

              </tbody>
            </table>

            <div className="text-center">
              <button type="button" className="btn btn-outline-primary m-1"><Link className="nav-link" to="/">Back to shopping</Link></button>
              <button type="button" className="btn btn-primary m-1"><Link className="nav-link" to="/customer/order">Continue To Order</Link></button>
            </div>

          </div>
        </div>
      </div>
    </>
  )
}

export default CartBody