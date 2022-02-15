import React, { Component } from 'react';
import Sidebar from './Sidebar';
// import Content from './Content';
import Content from './Grafico';
 
function Main() {
  return (
    <div id="page">
      
      <div className="main-sidebar" id="sideBar">
        <Sidebar />
      </div>

      <div className="main-content" id="content">
        <Content />
      </div>

    </div>
  );
}

export default Main;