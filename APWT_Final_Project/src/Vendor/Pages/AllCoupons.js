import React from 'react'
import LogedHeader from '../Components/LogedHeader'
import CouponBar from '../Components/CouponBar'
import AllCouponsBody from '../Components/AllCouponsBody'
import Footer from '../../Public/Components/Footer'

const AllCoupons = () => {
  return (
    <>
      <LogedHeader />
      <CouponBar />
      <AllCouponsBody/>
      <Footer />
    </>
  )
}

export default AllCoupons