import React from 'react';
import DataTable from './DataTable';

class IndexProyecto extends React.Component {
	render() {

		const headings = [
			'Nombre de Proyecto',
			'Encargado',
			'Ubicacion',
			'Cantidad de Datos',
		];

		const rows = [
			[
				'Red and black plaid scarf with thin red stripes and thick black stripes',
				'Juan Perez',
				'Parana, Entre Rios',
				12,
			],
			[
				'Yellow plaid scarf',
				'Juan Perez',
				'Parana, Entre Rios',
				10,
			],
			[
				'Blue plaid scarf',
				'Juan Perez',
				'Parana, Entre Rios',
				22,
			],
			[
				'Pink plaid scarf',
				'Juan Perez',
				'Parana, Entre Rios',
				100,
			],
		];

		return (
			<div className="container">
				<DataTable headings={headings} rows={rows} />
			</div>
		);
	}
}
export default IndexProyecto;