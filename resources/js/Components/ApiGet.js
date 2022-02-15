import React from 'react';

class ApiGet extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			nombre: '',
			descripcion: '',
			errorMessage: '',
			error: false,
			isLoading: false
		}
		this.onClick = this.onClick.bind(this);
	}

	componentDidMount() {
		console.log("Componente GET Montado");
	}

	componentWillUnmount() {
		console.log("Componente GET desMontado");
	}

	async onClick(e) {
		e.preventDefault();
		this.setState({
			isLoading: true,
			error: false,
			errorMessage: ''
		});
		this.setState({
			nombre: 'Jona',
			descripcion: 'Santana'
		});
		const data = await fetch('http://localhost:3000/api/post', {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json',
				Accept: 'application/json'
			}
		}).then(response => response.json())
			.then(data => console.log(data));
	}

	render() {
		return (
			<div>
				<button className="btn btn-primary" onClick={this.onClick} > API TEST</button>
				<h2>Nombre: {this.state.nombre}.</h2>
				<h2>Desc: {this.state.descripcion}.</h2>
			</div>
		);
	}
}
export default ApiGet;