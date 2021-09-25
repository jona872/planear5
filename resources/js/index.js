import React,{Component} from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from "react-router-dom";
import Header from './Components/Header';
import Grafico from './Components/Grafico';
import Main from './Components/Main';
import Test from './Test';

class App extends Component{
render(){
        return(
            <div className="Application">
                <Router>
                    {/* <Header/    > */}
                    {/* <Main /> */}
                    <Grafico />
                </Router>
            </div>
        );
    }

};

export default App;

if (document.getElementById('react-js')) {
    ReactDOM.render(<App/>, document.getElementById('react-js'));
}
