import React from 'react'
import { useState } from 'react';
import LogedHeader from '../Components/LogedHeader'
import ProductBar from '../Components/ProductBar'
import Footer from '../../Public/Components/Footer'
import ProductChartData from "../Components/ProductChartData"
import ProductCategories from '../../Public/Components/ProductCategories'
import Products from '../Components/Products'

const AllProducts = () => {
  const [msg, setMsg] = useState(localStorage.getItem('msg'));
  const remove = () => {
    localStorage.setItem('msg', '');
    setMsg("");
    window.location.href = "/vendor/allProducts";
  }
  return (
    <>
      <LogedHeader />
      <ProductBar />
      {
        msg ?
          <div className="container mt-3">
            <div className="alert alert-success alert-dismissible">
              <button type="button" className="btn-close" data-bs-dismiss="alert" onClick={remove}></button>
              <strong>Success!</strong> {msg}
            </div>
          </div>
        : ''
      }
      <ProductChartData/>
      <ProductCategories />
      <Products />
      <Footer />
    </>
  )
}

export default AllProducts