import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

// import LandingPage from './Pages/LandingPage';
// import RegPage from './Pages/RegPage';

import LandingPage from './Public/Pages/LandingPage';
import RegPage from './Public/Pages/RegPage';

import VendorList from './Public/VendorList';

function Main() {
  return (
    <div>
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<LandingPage />} />
          <Route path="/reg-page" element={<RegPage />} />

          <Route path="/list" element={<VendorList />} />

        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default Main