import LogedHeader from "../Components/LogedHeader"
import ProductBar from '../Components/ProductBar'
import ProductChartData from "../Components/ProductChartData"
import ProductChartBody from "../Components/ProductCharBody"
import Footer from "../../Public/Components/Footer"

const ProductChart = () => {
  return (
    <>
    <LogedHeader/>
    <ProductBar />
    <ProductChartData/>
    <ProductChartBody/>
    <Footer/>
    </>
  )
}

export default ProductChart