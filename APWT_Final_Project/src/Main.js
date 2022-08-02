import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

// Public
import LandingPage from './Public/Pages/LandingPage';
import RegPage from './Public/Pages/RegPage';
import ProductByCategory from './Public/Pages/ProductByCategory';

// Customer
import Dashboard from './Customer/Pages/Dashboard';
import ProfileInfo from './Customer/Pages/ProfileInfo';
import VendorList from './Public/VendorList';


const Main = () => {
  return (
    <div>
      <BrowserRouter>
        <Routes>

          {/* Public Route */}
          <Route path="/" element={<LandingPage />} />
          <Route path="/registration" element={<RegPage />} />
          <Route path="/categories/:category" element={<ProductByCategory />} />

          {/* Customer Routes */}
          <Route path="/customer/dashboard" element={<Dashboard />} />
          <Route path="/customer/categories/:category" element={<ProductByCategory />} />
          <Route path="/customer/profileinfo" element={<ProfileInfo />} />


          <Route path="/list" element={<VendorList />} />

        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default Main