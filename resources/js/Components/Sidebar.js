import React from 'react';

function Sidebar() {
    return (
        <div className="list-group list-group-flush">
            <a className="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Proyectos</a>
            <a className="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Herramientas</a>
            <a className="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Relevamientos</a>
            <a className="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Crear Docente</a>
            <a className="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Profile</a>
        </div>
    );
}

export default Sidebar;

