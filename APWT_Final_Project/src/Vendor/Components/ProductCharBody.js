import React, { Component } from "react";
import Chart from "react-apexcharts";

class ProductCharBody extends Component {
  constructor(props) {
    super(props);

    this.state = {
      options: {
        title: {
          text: 'Category Wise Product Amount' ,
          align: 'center',
          margin: 10,
          offsetX: 0,
          offsetY: 0,
          floating: false,
          style: {
            fontSize:  '20px',
            fontWeight:  'bold',
            fontFamily:  '',
            color:  '#263238'
          },
        },
        chart: {
          id: "Category Wise Product Amount"
        },
        xaxis: {
          categories: [
            'Fruits & Vegetables', 
            'Meat & Fish', 
            'Cooking', 
            'Baking', 
            'Dairy', 
            'Candy & Chocolate', 
            'Frozen & Canned', 
            'Bread & Bakery', 
            'Breakfast', 
            'Snacks', 
            'Beverages', 
            'Others'
        ]
        }
      },
      series: [
        {
          name: "Product Amount",
          data: [
            localStorage.getItem('FruitsVegetables'), 
            localStorage.getItem('MeatFish'), 
            localStorage.getItem('Cooking'), 
            localStorage.getItem('Baking'), 
            localStorage.getItem('Dairy'), 
            localStorage.getItem('CandyChocolate'), 
            localStorage.getItem('FrozenCanned'), 
            localStorage.getItem('BreadBakery'), 
            localStorage.getItem('Breakfast'), 
            localStorage.getItem('Snacks'), 
            localStorage.getItem('Beverages'), 
            localStorage.getItem('Others')
        ]
        }
      ]
    };
  }
  
  render() {
    return (
      <div className="app">
        <center>
        <Chart
              options={this.state.options}
              series={this.state.series}
              type="bar"
              width="90%"
              height= '500'
            />
        </center>
      </div>
    );
  }
}

export default ProductCharBody;