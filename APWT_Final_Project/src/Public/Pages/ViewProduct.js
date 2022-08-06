import { useParams } from "react-router-dom"
import Footer from "../Components/Footer";
import Header from "../Components/Header";
import ViewProductBody from "../Components/ViewProductBody";

const ViewProduct = () => {
    const{id} = useParams();

  return (
    <>
      <Header/>
      <ViewProductBody value={id}/>
      <Footer/>
    </>
  )
}

export default ViewProduct