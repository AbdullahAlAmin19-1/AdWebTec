import React from 'react'
import LogedHeader from '../Components/LogedHeader'
import ProductBar from '../Components/ProductBar'
import Footer from '../../Public/Components/Footer'
import ProductCategories from '../../Public/Components/ProductCategories'
import Products from '../Components/Products'

const AllProducts = () => {
  return (
    <>
      <LogedHeader />
      <ProductBar />
      <ProductCategories />
      <Products />
      <Footer />
    </>
  )
}

export default AllProducts