import {useParams} from 'react-router-dom';

import Footer from "../../Public/Components/Footer"
import AdHeader from "../Components/AdHeader"
import SearchProductBody from "../Components/SearchProductBody"

const AsearchProduct = () => {
    const{keyword} = useParams();
  return (
    <>
      <AdHeader/>
      <SearchProductBody keyword={keyword}/>
      <Footer/>
    </>
  )
}

export default AsearchProduct