import AdHeader from "../Components/AdHeader"
import { useParams } from "react-router-dom"
import Footer from "../../Public/Components/Footer"
import Editcoupon from "../Components/Editcoupon"

const Aeditcoupon = () => {
    const{id} = useParams();
  return (
    <>
    <AdHeader/>
    <Editcoupon co_id={id}/>
    <Footer/>
    </>
  )
}

export default Aeditcoupon