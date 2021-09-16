import React, { Component } from 'react';
import Sidebar from './Sidebar';
import Content from './Content';




function Main() {
  return (
    <div className="d-flex">
      
      <div className="main-sidebar border-end bg-white">
        <Sidebar />
      </div>

      <div className="main-content">
        <Content />
      </div>

    </div>
  );
}

export default Main;