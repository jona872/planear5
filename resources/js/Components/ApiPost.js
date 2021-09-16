import React from 'react';

class ApiPost extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            nombre: '',
            creador: '',
            errorMessage: '',
            error: false,
            isLoading: false
        }
        this.onClick = this.onClick.bind(this);
    }

    componentDidMount() {
        console.log("Componente POST Montado");
    }

    componentWillUnmount() {
        console.log("Componente POST desMontado");
    }

    async onClick(e) {
        e.preventDefault();
        this.setState({
            isLoading: true,
            error: false,
            errorMessage: ''
        });
        var url = 'http://localhost:3000/api/proyecto';
        var data = { nombre: 'PlanearNombre', creador: 'PlanearCreador', descripcion: 'PlanearDescripcion' };

        fetch(url, {
            method: 'POST', // or 'PUT'
            body: JSON.stringify(data), // data can be `string` or {object}!
            // body: JSON.stringify({
            // 	"nombre": this.state.nombre,
            // 	"creador": this.state.creador,
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json'
            }
        }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then(response => console.log('Success:', response));

    }

    render() {
        return (
            <button className="btn btn-primary" onClick={this.onClick} > API POST TEST</button>
        );
    }
}
export default ApiPost;