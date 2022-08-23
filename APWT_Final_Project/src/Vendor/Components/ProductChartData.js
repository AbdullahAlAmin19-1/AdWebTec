import { useState, useEffect } from 'react';
import AxiosConfig from '../../Public/Services/AxiosConfig';
import ProductCharBody from './ProductCharBody';

const ProductChartData = () => {
  
  useEffect(() => {
    document.title='Product Amount';
    AxiosConfig.get("vendor/productChartData").then((succ) => {
        debugger;
        localStorage.setItem('FruitsVegetables', succ.data.FruitsVegetables);
        localStorage.setItem('MeatFish', succ.data.MeatFish);
        localStorage.setItem('Cooking', succ.data.Cooking);
        localStorage.setItem('Baking', succ.data.Baking);
        localStorage.setItem('Dairy', succ.data.Dairy);
        localStorage.setItem('CandyChocolate', succ.data.CandyChocolate);
        localStorage.setItem('FrozenCanned', succ.data.FrozenCanned);
        localStorage.setItem('BreadBakery', succ.data.BreadBakery);
        localStorage.setItem('Breakfast', succ.data.Breakfast);
        localStorage.setItem('Snacks', succ.data.Snacks);
        localStorage.setItem('Beverages', succ.data.Beverages);
        localStorage.setItem('Others', succ.data.Others);
    }, (er) => {
        debugger;
        alert("Not working");
    })
  }, []);
  
  return (
    <>
    <br/>
    {/* <center><h4 className="mb-2 text-primary">Category Wise Product Amount</h4></center> */}
    {/* <ProductCharBody/> */}
    </>
    )
  }
  
  export default ProductChartData