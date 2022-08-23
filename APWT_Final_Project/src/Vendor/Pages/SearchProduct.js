import {useParams} from 'react-router-dom';

import Footer from "../../Public/Components/Footer"
import LogedHeader from '../Components/LogedHeader'
import SearchProductBody from "../Components/SearchProductBody"

const SearchProduct = () => {
    const{keyword} = useParams();
  return (
    <>
      <LogedHeader />
      <SearchProductBody keyword={keyword}/>
      <Footer/>
    </>
  )
}

export default SearchProduct