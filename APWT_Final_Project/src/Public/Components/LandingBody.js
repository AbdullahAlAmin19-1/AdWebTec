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
                <img style={{ width: "150px" }} src="./categories/fruits-vegetables.webp" alt="" /> <br />
                Fruits & Vegetables</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/meat-fish.webp" alt="" /> <br />
                Meat & Fish</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/cooking.webp" alt="" /> <br />
                Cooking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/baking.webp" alt="" /> <br />
                Baking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/dairy.webp" alt="" /> <br />
                Dairy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/candy-chocolate.webp" alt="" /> <br />
                Candy & Chocolate</a>
            </li>
          </ul>
        </div>

        <div className="row">
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/frozen-canned.webp" alt="" /> <br />
                Frozen & Canned</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/bread-bakery.webp" alt="" /> <br />
                Bread & Bakery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/breakfast.webp" alt="" /> <br />
                Breakfast</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/snacks.webp" alt="" /> <br />
                Snacks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/beverages.webp" alt="" /> <br />
                Beverages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img style={{ width: "150px" }} src="./categories/others.webp" alt="" /> <br />
                Others</a>
            </li>
          </ul>
        </div>
      </div>

    </>
  )
}

export default LandingBody