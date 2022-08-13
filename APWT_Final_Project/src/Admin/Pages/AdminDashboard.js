import Footer from "../../Public/Components/Footer"
import AdHeader from "../Components/AdHeader"
import ProductCategories from "../../Public/Components/ProductCategories"
import Products from "../../Public/Components/Products"

const AdminDashboard = () => {
  return (
    <div>
    
    <AdHeader/>
    <ProductCategories />
    <Products/>
    <Footer/>
    
    </div>
  )
}

export default AdminDashboard