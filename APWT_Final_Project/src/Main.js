import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

// Public
import LandingPage from './Public/Pages/LandingPage';
import RegPage from './Public/Pages/RegPage';
import LoginPage from './Public/Pages/LoginPage';
import Logout from './Public/Components/Logout';
import ProductByCategory from './Public/Pages/ProductByCategory';
import ViewProduct from './Public/Pages/ViewProduct';
import SearchProduct from './Public/Pages/SearchProduct';

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
import VDeleteCoupon from './Vendor/Components/DeleteCoupon';

// Customer
import Dashboard from './Customer/Pages/Dashboard';
import ProfileInfo from './Customer/Pages/ProfileInfo';
import EditProfile from './Customer/Pages/EditProfile'
import Cart from './Customer/Pages/Cart';
import Reviews from './Customer/Pages/Reviews';
import ReviewUpdate from './Customer/Pages/ReviewUpdate';
import Coupons from './Customer/Pages/Coupons';
import Notices from './Customer/Pages/Notices';


// Admin
import AdminDashboard from './Admin/Pages/AdminDashboard';
import Aprofile from './Admin/Pages/Aprofile';
import Aeditprofile from './Admin/Pages/Aeditprofile'
import Asendnotice from './Admin/Pages/Asendnotice';
import Aviewallnotice from './Admin/Pages/Aviewallnotice';
import Aviewnotice from './Admin/Pages/Aviewnotice';
import Aeditnotice from './Admin/Pages/Aeditnotice';
import Aapprovecoupon from './Admin/Pages/Aapprovecoupon';
import Aaddcoupon from './Admin/Pages/Aaddcoupon';
import Aviewcoupon from './Admin/Pages/Aviewcoupon';
import Aeditcoupon from './Admin/Pages/Aeditcoupon';


const Main = () => {
  return (
    <div>
      <BrowserRouter>
        <Routes>

          {/* Public Route */}
          <Route path="/" element={<LandingPage />} />
          <Route path="/registration" element={<RegPage />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/logout" element={<Logout />} />
          <Route path="/categories/:category" element={<ProductByCategory />} />
          <Route path="/products/item/:id" element={<ViewProduct />} />
          <Route path="/searchproduct/:keyword" element={<SearchProduct />} />

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
          <Route path="/vendor/deleteCoupon/:id" element={<VDeleteCoupon />} />

          {/* Customer Routes */}
          <Route path="/customer/dashboard" element={<Dashboard />} />
          <Route path="/customer/profileinfo" element={<ProfileInfo />} />
          <Route path="/customer/profileinfo/edit/:id" element={<EditProfile />} />
          <Route path="/customer/cart" element={<Cart />} />
          <Route path="/customer/reviews" element={<Reviews />} />
          <Route path="/customer/reviewupdate/:id" element={<ReviewUpdate />} />
          <Route path="/customer/coupons" element={<Coupons />} />
          <Route path="/customer/notices" element={<Notices />} />

          {/* Admin Routes */}
          <Route path="/admin/dashboard" element={<AdminDashboard />} />
          <Route path="/admin/profile" element={<Aprofile />} />
          <Route path="/admin/profile/edit/:id" element={<Aeditprofile />} />
          <Route path="/admin/sendnotice" element={<Asendnotice />} />
          <Route path="/admin/viewallnotice" element={<Aviewallnotice />} />
          <Route path="/admin/viewnotice/:id" element={<Aviewnotice />} />
          <Route path="/admin/editnotice/:id" element={<Aeditnotice />} />
          <Route path="/admin/editcoupon/:id" element={<Aeditcoupon />} />
          <Route path="/admin/approvecoupon" element={<Aapprovecoupon />} />
          <Route path="/admin/addcoupon" element={<Aaddcoupon />} />
          <Route path="/admin/viewcoupon" element={<Aviewcoupon />} />
        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default Main