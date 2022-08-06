import { Link } from "react-router-dom";
import { useEffect } from "react";

const CartBody = () => {

  useEffect(() => {

    var sum = 1+2;
    alert(sum);

    // axios.get("http://localhost:8000/api/customer/profileinfo").then(
    //     (res) => {
    //         setCustomer(res.data);
    //         // debugger;
    //     },
    //     (error) => {
    //         debugger;
    //     }

    // );
},[]);

  return (
    <>
      <div className="container-fluid p-4">
        <div className="card">
          <div className="card-header">
            <h3>Shopping Cart</h3>
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

                <tr className="text-center">
                  <td className="p-1">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Product Image"
                      style={{ width: "50px" }}/>
                  </td>
                  <td>Lorem ipsum dolor sit amet consectetur, adipisicing eli</td>
                  <td>Lore ipsum</td>
                  <td>120</td>
                  <td>3</td>
                  <td>360</td>
                  <td><button type="button" className="btn btn-danger">
                    <Link className="nav-link" to="#">Remove Product</Link>
                  </button></td>
                </tr>

                <tr className="text-center">
                  <td className="p-1">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Product Image"
                      style={{ width: "50px" }}/>
                  </td>
                  <td>Lorem ipsum dolor sit amet consectetur, adipisicing eli</td>
                  <td>Lore ipsum</td>
                  <td>120</td>
                  <td>3</td>
                  <td>360</td>
                  <td><button type="button" className="btn btn-danger">
                    <Link className="nav-link" to="#">Remove Product</Link>
                  </button></td>
                </tr>

              </tbody>
            </table>

            <div className="text-center">
              <button type="button" className="btn btn-outline-primary m-1"><Link className="nav-link" to="/customer/dashboard">Back to shopping</Link></button>
              <button type="button" className="btn btn-primary m-1">Continue To Order</button>
            </div>

          </div>
        </div>
      </div>
    </>
  )
}

export default CartBody