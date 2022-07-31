import React from 'react'
import { Link } from 'react-router-dom';

const LandingBody = () => {
  return (
    <>
      <div className="container-fluid py-4 text-center">
        <div className="row">
          <h3 className='text-center'>Product By Categories</h3>
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/fruits-vegetables.webp" alt="" /> <br />
                Fruits & Vegetables</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/meat-fish.webp" alt="" /> <br />
                Meat & Fish</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/cooking.webp" alt="" /> <br />
                Cooking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/baking.webp" alt="" /> <br />
                Baking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/dairy.webp" alt="" /> <br />
                Dairy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/candy-chocolate.webp" alt="" /> <br />
                Candy & Chocolate</a>
            </li>
          </ul>
        </div>

        <div className="row">
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/frozen-canned.webp" alt="" /> <br />
                Frozen & Canned</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/bread-bakery.webp" alt="" /> <br />
                Bread & Bakery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/breakfast.webp" alt="" /> <br />
                Breakfast</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/snacks.webp" alt="" /> <br />
                Snacks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/beverages.webp" alt="" /> <br />
                Beverages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="Images/Categories/others.webp" alt="" /> <br />
                Others</a>
            </li>
          </ul>
        </div>
      </div>

    </>
  )
}

export default LandingBody