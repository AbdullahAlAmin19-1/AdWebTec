import {useParams} from 'react-router-dom';

import Header from '../Components/Header';
import CategoryBody from '../Components/CategoryBody';
import Footer from '../Components/Footer';

const ProductByCategory = () => {
    const{category} = useParams();
    alert(category);

  return (
    <>
      <Header/>
      <CategoryBody/>
      <Footer/>
    </>
  )
}

export default ProductByCategory