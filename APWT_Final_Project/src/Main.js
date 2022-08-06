import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

// Public
import LandingPage from './Public/Pages/LandingPage';
import RegPage from './Public/Pages/RegPage';
import LoginPage from './Public/Pages/LoginPage';
import ProductByCategory from './Public/Pages/ProductByCategory';

// Customer
import Dashboard from './Customer/Pages/Dashboard';
import ProfileInfo from './Customer/Pages/ProfileInfo';
import EditProfile from './Customer/Pages/EditProfile'
import Cart from './Customer/Pages/Cart';

import VendorList from './Public/VendorList';
import Products from './Public/Components/Products';

const Main = () => {
  return (
    <div>
      <BrowserRouter>
        <Routes>

          {/* Public Route */}
          <Route path="/" element={<LandingPage />} />
          <Route path="/registration" element={<RegPage />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/categories/:category" element={<ProductByCategory />} />

          <Route path="/products" element={<Products />} />

          {/* Customer Routes */}
          <Route path="/customer/dashboard" element={<Dashboard />} />
          <Route path="/customer/profileinfo" element={<ProfileInfo />} />
          <Route path="/customer/profileinfo/edit/:id" element={<EditProfile />} />
          <Route path="/customer/cart" element={<Cart />} />


          <Route path="/list" element={<VendorList />} />

        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default Main