import React from "react";
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

// Each logical "route" has two components, one for
// the sidebar and one for the main area. We want to
// render both of them in different places when the
// path matches the current URL.

// We are going to use this route config in 2
// spots: once for the sidebar and once in the main
// content section. All routes are in the same
// order they would appear in a <Switch>.
const routes = [
  {
    path: "/",
    exact: true,
    main: () => <h2>Proyectos</h2>
  },
  {
    path: "/herramientas",
    main: () => <h2>Herramientas</h2>
  },
  {
    path: "/relevamientos",
    main: () => <h2>relevamientos</h2>
  }
];

export default function SidebarExample() {
  return (
    <Router>
      <div id="page">
        <div id="sideBar">
          <ul>
            <li>
              <Link to="/">Proyectos</Link>
            </li>
            <li>
              <Link to="/herramientas">Herramientas</Link>
            </li>
            <li>
              <Link to="/relevamientos">relevamientos</Link>
            </li>
          </ul>

          {/* <Switch>
            {routes.map((route, index) => (
              // You can render a <Route> in as many places
              // as you want in your app. It will render along
              // with any other <Route>s that also match the URL.
              // So, a sidebar or breadcrumbs or anything else
              // that requires you to render multiple things
              // in multiple places at the same URL is nothing
              // more than multiple <Route>s.
              <Route
                key={index}
                path={route.path}
                exact={route.exact}
                children={<route.sidebar />}
              />
            ))}
          </Switch> */}
        </div>

        <div id="content">
          <Switch>
            {routes.map((route, index) => (
              // Render more <Route>s with the same paths as
              // above, but different components this time.
              <Route
                key={index}
                path={route.path}
                exact={route.exact}
                children={<route.main />}
              />
            ))}
          </Switch>
        </div>
      </div>
    </Router>
  );
}
