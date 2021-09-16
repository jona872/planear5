import React, { Component } from 'react';
import { Switch, Route, Link } from "react-router-dom";
import axios from "axios";
import Blog from './Blog/BlogIndex';
import CreateBlog from './Blog/BlogCreate';
import BlogDetail from "./Blog/BlogList/BlogDetail";
import url from "../url"

import Button from 'react-bootstrap/Button';
import ButtonToolbar from 'react-bootstrap/ButtonToolbar';

axios.defaults.baseURL = 'http://localhost:3000/api'; //Desde FrontEnd -> Testear esto en remoto(OJO)
// axios.defaults.baseURL = 'http://127.0.0.1:8000/api'; //artisan serve
// axios.defaults.baseURL = 'http://localhost/laravel-reactjs-crud/public/api'; //lampp
// axios.defaults.baseURL = 'http://planear5.herokuapp.com/api'; //heroku 
//axios.defaults.baseURL = url;

const Home = () => <span>Home</span>;

const Crear = () => <span>Crear Blog</span>;

class Header extends Component {
    render() {
        return (
            <div className="HeaderSection">

                <nav className="navbar navbar-expand-lg navbar-dark bg-primary">
                    <div className="collapse navbar-collapse" >
                        <ButtonToolbar className="custom-btn-toolbar">
                            <Link className="nav-link" to="/home">
                                <Button>Home</Button>
                            </Link>

                            <Link className="nav-link" to="./create-blog">
                                <Button>Crear</Button>
                            </Link>
                        </ButtonToolbar>



                        {/* <ul className="navbar-nav">
                            <li className="nav-item active">
                                <Button></Button>
                                <Link className="nav-link" to="/home">Home</Link>

                            </li>
                            <li className="nav-item active">
                                <Link className="nav-link" to="./create-blog">Create Blog</Link>
                            </li>

                        </ul> */}
                    </div>
                </nav>

                <Switch>
                    <Route exact path="/home">
                        <Blog />
                    </Route>
                    <Route path="/create-blog">
                        <CreateBlog />
                    </Route>
                    <Route path="/post/:id" render={props => <BlogDetail postID=":id" {...props} />}>
                    </Route>
                </Switch>

            </div>
        );
    }
}

export default Header;