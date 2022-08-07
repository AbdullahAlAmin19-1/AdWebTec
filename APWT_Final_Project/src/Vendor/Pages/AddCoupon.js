import React from 'react'
import LogedHeader from '../Components/LogedHeader'
import CouponBar from '../Components/CouponBar'
import AddCouponBody from '../Components/AddCouponBody'
import Footer from '../../Public/Components/Footer'

const AddCoupon = () => {
  return (
    <>
      <LogedHeader />
      <CouponBar />
      <AddCouponBody/>
      <Footer />
    </>
  )
}

export default AddCoupon