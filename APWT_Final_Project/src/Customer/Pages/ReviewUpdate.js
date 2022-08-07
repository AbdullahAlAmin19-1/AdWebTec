import { useParams } from "react-router-dom"
import Footer from "../../Public/Components/Footer"
import CusHeader from "../Components/CusHeader"
import ReviewUpdateView from "../Components/ReviewUpdateView"

const ReviewUpdate = () => {
    const{id} = useParams();

  return (
    <>
      <CusHeader/>
      <ReviewUpdateView value={id}/>
      <Footer/>
    </>
  )
}

export default ReviewUpdate