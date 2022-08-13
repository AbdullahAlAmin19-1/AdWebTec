import AdHeader from "../Components/AdHeader"
import { useParams } from "react-router-dom"
import Footer from "../../Public/Components/Footer"
import Editnotice from "../Components/Editnotice"

const Aeditnotice = () => {
    const{id} = useParams();
  return (
    <>
    <AdHeader/>
    <Editnotice n_id={id}/>
    <Footer/>
    </>
  )
}

export default Aeditnotice