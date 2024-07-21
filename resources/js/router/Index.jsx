import React from 'react'
import { Routes, Route } from 'react-router-dom'

import Home from '../Pages/Home';
import About from '../Pages/About';

import LoginForm from '../Pages/Auth/LoginForm';

import NotFound from '../Pages/NotFound';

const Index = () => {
  return (
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/auth" element={<LoginForm />} />
        <Route path="/*" element={ <NotFound /> } />
      </Routes>
  )
}

export default Index
