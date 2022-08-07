import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

// Public
import LandingPage from './Public/Pages/LandingPage';
import RegPage from './Public/Pages/RegPage';
import LoginPage from './Public/Pages/LoginPage';
import ProductByCategory from './Public/Pages/ProductByCategory';

// Vendor
import VAllProducts from './Vendor/Pages/AllProducts';
import VAddProduct from './Vendor/Pages/AddProduct';
import VEditProduct from './Vendor/Pages/EditProduct';
import VDeleteProduct from './Vendor/Components/DeleteProduct';
import VProfile from './Vendor/Pages/Profile';
import VEditProfile from './Vendor/Pages/EditProfile';
import VAllCoupons from './Vendor/Pages/AllCoupons';
import VAddCoupon from './Vendor/Pages/AddCoupon';
import VEditCoupon from './Vendor/Pages/EditCoupon';

// Customer
import Dashboard from './Customer/Pages/Dashboard';
import ProfileInfo from './Customer/Pages/ProfileInfo';
import EditProfile from './Customer/Pages/EditProfile'
import Cart from './Customer/Pages/Cart';

import VendorList from './Public/VendorList';
import ViewProduct from './Public/Pages/ViewProduct';

// Admin
import AdminDashboard from './Admin/Pages/AdminDashboard';

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
          <Route path="/products/item/:id" element={<ViewProduct />} />

          {/* Vendor Routes */}
          <Route path="/vendor/allProducts" element={<VAllProducts />} />
          <Route path="/vendor/addProduct" element={<VAddProduct />} />
          <Route path="/vendor/editProduct/:id" element={<VEditProduct />} />
          <Route path="/vendor/deleteProduct/:id" element={<VDeleteProduct />} />
          <Route path="/vendor/profile" element={<VProfile />} />
          <Route path="/vendor/editProfile/:id" element={<VEditProfile />} />
          <Route path="/vendor/allCoupons" element={<VAllCoupons />} />
          <Route path="/vendor/addCoupon" element={<VAddCoupon />} />
          <Route path="/vendor/editCoupon/:id" element={<VEditCoupon />} />
          <Route path="/vendor/deleteCoupon/:id" element={<VEditCoupon />} />

          {/* Customer Routes */}
          <Route path="/customer/dashboard" element={<Dashboard />} />
          <Route path="/customer/profileinfo" element={<ProfileInfo />} />
          <Route path="/customer/profileinfo/edit/:id" element={<EditProfile />} />
          <Route path="/customer/cart" element={<Cart />} />


          <Route path="/list" element={<VendorList />} />

          {/* Admin Routes */}
          <Route path="/admin/dashboard" element={<AdminDashboard />} />
        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default Main