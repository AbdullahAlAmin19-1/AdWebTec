import { useParams } from "react-router-dom"
import LogedHeader from "../Components/LogedHeader"
import Footer from "../../Public/Components/Footer"
import EditProfileBody from "../Components/EditProfileBody"

const EditProfile = () => {
  
  const{id} = useParams();

  return (
    <>
      <LogedHeader/>
      <EditProfileBody id={id}/>
      <Footer/>
    </>
  )
}

export default EditProfile