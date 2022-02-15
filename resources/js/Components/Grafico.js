import React from 'react';
import { Line } from 'react-chartjs-2';

 async function fetchMoviesJSON() {
	const response = await fetch('http://localhost:3000/api/post');
	const movies = await response.json();
	return movies;
 }
 fetchMoviesJSON().then(movies => {
	movies; // fetched movies
	let datos = movies.value;
	console.log(datos);
	datos.forEach( function(valor, indice, array) {
		console.log(indice);
		console.log("Answer= "+valor.answer_name+", ID="+valor.id);
  });
 });



const data = {
	labels: ['1', '2', '3', '4', '5', '6'],
	datasets: [
		{
			label: '# of Votes',
			data: [12, 19, 3, 5, 2, 3],
			fill: false,
			backgroundColor: 'rgb(255, 99, 132)',
			borderColor: 'rgba(255, 99, 132, 0.2)',
		},
	],
};

const options = {
	scales: {
		yAxes: [
			{
				ticks: {
					beginAtZero: true,
				},
			},
		],
	},
};

const Grafico = () => (
	<div className="card">
		<div className="card-header">
			<i className="fa fa-align-justify"></i> Graficos
		</div>
		<div className="card-body">
			<Line data={data} options={options} />
		</div>
	</div>
);

export default Grafico;
