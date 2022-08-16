import {useParams} from 'react-router-dom';

import Header from '../Components/Header';
import CategoryBody from '../Components/CategoryBody';
import Footer from '../Components/Footer';
import ProductCategories from '../Components/ProductCategories';

const ProductByCategory = () => {
    const{category} = useParams();
    // alert(category);

  return (
    <>
      <Header/>
      <ProductCategories/>
      <CategoryBody category={category}/>
      <Footer/>
    </>
  )
}

export default ProductByCategory