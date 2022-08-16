import {useParams} from 'react-router-dom';

import Footer from "../Components/Footer"
import Header from "../Components/Header"
import ProductCategories from '../Components/ProductCategories';
import SearchProductBody from "../Components/SearchProductBody"

const SearchProduct = () => {
    const{keyword} = useParams();
  return (
    <>
      <Header/>
      <ProductCategories/>
      <SearchProductBody keyword={keyword}/>
      <Footer/>
    </>
  )
}

export default SearchProduct