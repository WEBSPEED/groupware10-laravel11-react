import React from 'react'

import HeaderLayout from "../Layouts/HeaderLayout"

import FooterLayout from "../Layouts/FooterLayout"

const AuthenticatedLayout = (props) => {
  return (
    <>
        <HeaderLayout />
          <main className="container-fluid">
            {props.children}
          </main>
        <FooterLayout/>
      
    </>
  )
}

export default AuthenticatedLayout
