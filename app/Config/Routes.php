<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home_c::index');
$routes->add('404_override', 'Home_c::page404');
$routes->add('errorpage', 'Home_c::page404');


/* START DONATION ROUTES */
$routes->add('donation/(:any)', 'Donation::donation/$1');
$routes->add('donation_step_2', 'Donation::donation_step_2');
$routes->add('donation_success', 'Donation::donation_success');
$routes->add('projects_details/(:any)', 'Projects::details/$1');


/* END DONATION ROUTES */


/* START ADMINS ROUTES */
$routes->add('admin-login', 'Admin_login_c::index');
$routes->add('admin-logout', 'Admin_login_c::logout');
$routes->add('admin-dashboard', 'Admin_c::admin_dashboard');
$routes->add('admin-update-profile', 'Admin_c::update_profile');
$routes->add('create-project', 'Admin_projects_c::create_project');
$routes->add('view-projects', 'Admin_projects_c::view_projects');
$routes->add('edit-projects/(:any)', 'Admin_projects_c::edit_projects/$1');
$routes->add('update-projects-status', 'Admin_projects_c::update_status');
$routes->add('delete-projects-image', 'Admin_projects_c::delete_projects_image');
/* END ADMINS ROUTES */

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
