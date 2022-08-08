import React from 'react'
import { useParams } from "react-router-dom"
import LogedHeader from '../Components/LogedHeader'
import CouponBar from '../Components/CouponBar'
import EditCouponBody from '../Components/EditCouponBody'
import Footer from '../../Public/Components/Footer'

const EditCoupon = () => {
  const{id} = useParams();
  return (
    <>
      <LogedHeader />
      <CouponBar />
       <EditCouponBody co_id={id}/> 
      <Footer />
    </>
  )
}

export default EditCoupon