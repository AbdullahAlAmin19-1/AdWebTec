import React from 'react'
import LogedHeader from '../Components/LogedHeader'
import ProductBar from '../Components/ProductBar'
import AddProductBody from '../Components/AddProductBody'
import Footer from '../../Public/Components/Footer'

const AddProduct = () => {
  return (
    <>
      <LogedHeader />
      <ProductBar />
      <AddProductBody/>
      <Footer />
    </>
  )
}

export default AddProduct