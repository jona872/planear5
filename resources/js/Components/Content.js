import React from 'react';
import Grafico from './Grafico';
import ApiGet from './ApiGet';
import ApiPost from './ApiPost';
import IndexProyecto from './Proyecto/IndexProyecto';



function Content() {
	return (
		<div>	
			<IndexProyecto />
			<br></br>
			{/* <ApiGet />
			<ApiPost />

			<Grafico /> */}
		</div>
	);
}

export default Content;