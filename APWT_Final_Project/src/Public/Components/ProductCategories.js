import React from 'react'

// Image Import
import fruitsvegetables from '../../Images/Categories/fruits-vegetables.webp'
import meatfish from '../../Images/Categories/meat-fish.webp'
import cooking from '../../Images/Categories/cooking.webp'
import baking from '../../Images/Categories/baking.webp'
import dairy from '../../Images/Categories/dairy.webp'
import candychocolate from '../../Images/Categories/candy-chocolate.webp'
import frozencanned from '../../Images/Categories/frozen-canned.webp'
import breadbakery from '../../Images/Categories/bread-bakery.webp'
import breakfast from '../../Images/Categories/breakfast.webp'
import snacks from '../../Images/Categories/snacks.webp'
import beverages from '../../Images/Categories/beverages.webp'
import others from '../../Images/Categories/others.webp'


const ProductCategories = () => {

  const remove = () => {
    localStorage.removeItem("loggedout");
    window.location.href = "/";
  }

  return (
    <>

      {
        localStorage.getItem('loggedout') == "yes" ?
          <div className="container">
            <div className="alert alert-primary alert-dismissible mt-4 mx-5">
              <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
              <strong>Success!</strong> User has been logged out successfully!
            </div>
          </div>
          : ''
      }

      <div className="container-fluid py-4 text-center">
        <div className="row">
          <h3 className='text-center'>Product By Categories</h3>
          <ul className="nav justify-content-center">
            <li className="nav-item">
              <a className="nav-link" href="/categories/Fruits & Vegetables">
                <img style={{ width: "150px" }} src={fruitsvegetables} alt="Product Categories" /> <br />
                Fruits & Vegetables</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Meat & Fish">
                <img style={{ width: "150px" }} src={meatfish} alt="Product Categories" /> <br />
                Meat & Fish</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Cooking">
                <img style={{ width: "150px" }} src={cooking} alt="Product Categories" /> <br />
                Cooking</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Baking">
                <img style={{ width: "150px" }} src={baking} alt="Product Categories" /> <br />
                Baking</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Dairy">
                <img style={{ width: "150px" }} src={dairy} alt="Product Categories" /> <br />
                Dairy</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Candy & Chocolate">
                <img style={{ width: "150px" }} src={candychocolate} alt="Product Categories" /> <br />
                Candy & Chocolate</a>
            </li>
          </ul>
        </div>

        <div className="row">
          <ul className="nav justify-content-center">
            <li className="nav-item">
              <a className="nav-link" href="/categories/Frozen & Canned">
                <img style={{ width: "150px" }} src={frozencanned} alt="Product Categories" /> <br />
                Frozen & Canned</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Bread & Bakery">
                <img style={{ width: "150px" }} src={breadbakery} alt="Product Categories" /> <br />
                Bread & Bakery</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Breakfast">
                <img style={{ width: "150px" }} src={breakfast} alt="Product Categories" /> <br />
                Breakfast</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Snacks">
                <img style={{ width: "150px" }} src={snacks} alt="Product Categories" /> <br />
                Snacks</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Beverages">
                <img style={{ width: "150px" }} src={beverages} alt="Product Categories" /> <br />
                Beverages</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/categories/Others">
                <img style={{ width: "150px" }} src={others} alt="Product Categories" /> <br />
                Others</a>
            </li>
          </ul>
        </div>
      </div>

    </>
  )
}

export default ProductCategories