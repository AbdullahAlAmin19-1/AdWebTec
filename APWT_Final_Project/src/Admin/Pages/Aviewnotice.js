import AdHeader from "../Components/AdHeader"
import { useParams } from "react-router-dom"
import Footer from "../../Public/Components/Footer"
import Viewnotice from "../Components/Viewnotice"

const Aviewnotice = () => {
    const{id} = useParams();
  return (
    <>
    <AdHeader/>
    <Viewnotice n_id={id}/>
    <Footer/>
    </>
  )
}

export default Aviewnotice