import React from 'react'
import LogedHeader from '../Components/LogedHeader'
import ProductBar from '../Components/ProductBar'
import Footer from '../../Public/Components/Footer'
import EditProduct from '../Components/EditProduct'

const LandingPage = () => {
  return (
    <>
      <LogedHeader />
      <ProductBar />
      <EditProduct />
      <Footer />
    </>
  )
}

export default LandingPage