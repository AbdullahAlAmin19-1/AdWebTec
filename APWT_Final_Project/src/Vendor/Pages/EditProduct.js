import React from 'react'
import { useParams } from "react-router-dom"
import LogedHeader from '../Components/LogedHeader'
import ProductBar from '../Components/ProductBar'
import Footer from '../../Public/Components/Footer'
import EditProductBody from '../Components/EditProductBody'

const EditProduct = () => {
  const{id} = useParams();
  return (
    <>
      <LogedHeader />
      <ProductBar />
      <EditProductBody p_id={id}/>
      <Footer />
    </>
  )
}

export default EditProduct