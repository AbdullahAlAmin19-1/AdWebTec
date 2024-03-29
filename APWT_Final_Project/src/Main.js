import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

// Public
import LandingPage from './Public/Pages/LandingPage';
import RegPage from './Public/Pages/RegPage';
import LoginPage from './Public/Pages/LoginPage';
import EmailLogin from './Public/Pages/EmailLogin';
import ELogin from './Public/Components/ELogin';
import Logout from './Public/Components/Logout';
import ProductByCategory from './Public/Pages/ProductByCategory';
import ViewProduct from './Public/Pages/ViewProduct';
import SearchProduct from './Public/Pages/SearchProduct';
import ForgotPass from './Public/Pages/ForgotPass';
import EnterOTP from './Public/Pages/EnterOTP';
import CreateNewPass from './Public/Pages/CreateNewPass';

// Vendor
import VAllProducts from './Vendor/Pages/AllProducts';
import VAddProduct from './Vendor/Pages/AddProduct';
import VEditProduct from './Vendor/Pages/EditProduct';
import VProfile from './Vendor/Pages/Profile';
import VEditProfile from './Vendor/Pages/EditProfile';
import VForgotPass from './Vendor/Pages/ForgotPass';
import VEnterOTP from './Vendor/Pages/EnterOTP';
import VCreateNewPass from './Vendor/Pages/CreateNewPass';
import VAllCoupons from './Vendor/Pages/AllCoupons';
import VAddCoupon from './Vendor/Pages/AddCoupon';
import VEditCoupon from './Vendor/Pages/EditCoupon';
import VNotice from './Vendor/Pages/Notice'
import VReviews from './Vendor/Pages/Reviews';
import VChangePass from './Vendor/Pages/ChangePass';
import VProductChart from './Vendor/Pages/ProductChart';
import VOrders from './Vendor/Pages/Orders';
import VSearchProduct from './Vendor/Pages/SearchProduct'

// Customer
import Dashboard from './Customer/Pages/Dashboard';
import ProfileInfo from './Customer/Pages/ProfileInfo';
import EditProfile from './Customer/Pages/EditProfile'
import ChangePass from './Customer/Pages/ChangePass';
import Cart from './Customer/Pages/Cart';
import Reviews from './Customer/Pages/Reviews';
import ReviewUpdate from './Customer/Pages/ReviewUpdate';
import Coupons from './Customer/Pages/Coupons';
import Notices from './Customer/Pages/Notices';
import Order from './Customer/Pages/Order';
import ViewOrder from './Customer/Pages/ViewOrder';


// Admin
import AdminDashboard from './Admin/Pages/AdminDashboard';
import Aprofile from './Admin/Pages/Aprofile';
import Aeditprofile from './Admin/Pages/Aeditprofile';
import Achangepassword from './Admin/Pages/Achangepassword';
import Asendnotice from './Admin/Pages/Asendnotice';
import Aviewallnotice from './Admin/Pages/Aviewallnotice';
import Aviewnotice from './Admin/Pages/Aviewnotice';
import Aeditnotice from './Admin/Pages/Aeditnotice';
import Aapprovecoupon from './Admin/Pages/Aapprovecoupon';
import Aaddcoupon from './Admin/Pages/Aaddcoupon';
import Aviewcoupon from './Admin/Pages/Aviewcoupon';
import Aeditcoupon from './Admin/Pages/Aeditcoupon';
import AsearchProduct from './Admin/Pages/AsearchProduct'
import Aapprovedeliveryman from './Admin/Pages/Aapprovedeliveryman';
import Aviewvendor from './Admin/Pages/Aviewvendor';
import Aviewcustomer from './Admin/Pages/Aviewcustormer';
import Aviewdeliveryman from './Admin/Pages/Aviewdeliveryman';


const Main = () => {
  return (
    <div>
      <BrowserRouter>
        <Routes>

          {/* Public Route */}
          <Route path="/" element={<LandingPage />} />
          <Route path="/registration" element={<RegPage />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/eLogin/:user_type/:username/:id" element={<ELogin />} />
          <Route path="/emailLogin" element={<EmailLogin />} />
          <Route path="/logout" element={<Logout />} />
          <Route path="/forgotPass" element={<ForgotPass />} />
          <Route path="/enterOTP" element={<EnterOTP />} />
          <Route path="/createNewPass" element={<CreateNewPass />} />
          <Route path="/categories/:category" element={<ProductByCategory />} />
          <Route path="/products/item/:id" element={<ViewProduct />} />
          <Route path="/searchproduct/:keyword" element={<SearchProduct />} />

          {/* Vendor Routes */}
          <Route path="/vendor/allProducts" element={<VAllProducts />} />
          <Route path="/vendor/addProduct" element={<VAddProduct />} />
          <Route path="/vendor/editProduct/:id" element={<VEditProduct />} />
          <Route path="/vendor/profile" element={<VProfile />} />
          <Route path="/vendor/editProfile/:id" element={<VEditProfile />} />
          <Route path="/vendor/forgotPass" element={<VForgotPass />} />
          <Route path="/vendor/enterOTP" element={<VEnterOTP />} />
          <Route path="/vendor/createNewPass" element={<VCreateNewPass />} />
          <Route path="/vendor/allCoupons" element={<VAllCoupons />} />
          <Route path="/vendor/addCoupon" element={<VAddCoupon />} />
          <Route path="/vendor/editCoupon/:id" element={<VEditCoupon />} />
          <Route path="/vendor/notices" element={<VNotice />} />
          <Route path="/vendor/reviews" element={<VReviews />} />
          <Route path="/vendor/changePass" element={<VChangePass />} />
          <Route path="/vendor/productChartData" element={<VProductChart />} />
          <Route path="/vendor/orders" element={<VOrders />} />
          <Route path="/vendor/searchproduct/:keyword" element={<VSearchProduct />} />

          {/* Customer Routes */}
          <Route path="/customer/dashboard" element={<Dashboard />} />
          <Route path="/customer/profileinfo" element={<ProfileInfo />} />
          <Route path="/customer/profileinfo/edit/:id" element={<EditProfile />} />
          <Route path="/customer/cart" element={<Cart />} />
          <Route path="/customer/reviews" element={<Reviews />} />
          <Route path="/customer/reviewupdate/:id" element={<ReviewUpdate />} />
          <Route path="/customer/coupons" element={<Coupons />} />
          <Route path="/customer/notices" element={<Notices />} />
          <Route path="/customer/changepass" element={<ChangePass />} />
          <Route path="/customer/order" element={<Order />} />
          <Route path="/customer/vieworder" element={<ViewOrder />} />

          {/* Admin Routes */}
          <Route path="/admin/dashboard" element={<AdminDashboard />} />
          <Route path="/admin/profile" element={<Aprofile />} />
          <Route path="/admin/profile/edit/:id" element={<Aeditprofile />} />
          <Route path="/admin/changepassword" element={<Achangepassword />} />
          <Route path="/admin/sendnotice" element={<Asendnotice />} />
          <Route path="/admin/viewallnotice" element={<Aviewallnotice />} />
          <Route path="/admin/viewnotice/:id" element={<Aviewnotice />} />
          <Route path="/admin/editnotice/:id" element={<Aeditnotice />} />
          <Route path="/admin/editcoupon/:id" element={<Aeditcoupon />} />
          <Route path="/admin/approvecoupon" element={<Aapprovecoupon />} />
          <Route path="/admin/addcoupon" element={<Aaddcoupon />} />
          <Route path="/admin/viewcoupon" element={<Aviewcoupon />} />
          <Route path="/admin/searchproduct/:keyword" element={<AsearchProduct />} />
          <Route path="/admin/approvedeliveryman" element={<Aapprovedeliveryman />} />
          <Route path="/admin/viewvendor" element={<Aviewvendor />} />
          <Route path="/admin/viewcustomer" element={<Aviewcustomer />} />
          <Route path="/admin/viewdeliveryman" element={<Aviewdeliveryman />} />
        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default Main