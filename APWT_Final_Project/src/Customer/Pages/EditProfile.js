import { useParams } from "react-router-dom"

import Footer from "../../Public/Components/Footer"
import CusHeader from "../Components/CusHeader"
import EditProfileBody from "../Components/EditProfileBody"

const EditProfile = () => {
  
  const{id} = useParams();

  return (
    <>
      <CusHeader/>
      <EditProfileBody id={id}/>
      <Footer/>
    </>
  )
}

export default EditProfile