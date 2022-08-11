import { useParams } from "react-router-dom"

import AdHeader from "../Components/AdHeader"
import Footer from "../../Public/Components/Footer"
import Editprofile from "../Components/Editprofile"

const Aeditprofile = () => {
    const{id} = useParams();
  return (
    <>
    <AdHeader/>
    <Editprofile a_id={id}/>
    <Footer/>
    </>
  )
}

export default Aeditprofile