<?php
/**
 * Collection of the allowed HTTP routes
 * First param: In which HTTP method the request is allowed
 * Second param: The accepted URI for the request
 * Third param: The class and method which should be called for rendering the view separated by '@'
 *
 * @author: Jonty Sponselee <jsponselee97@gmail.com>
 * @since: 3/18/2019
 */

return [
    ['GET', '', 'RinCMS\Site\Controllers\HomeController@show'],
    ['GET', '/admin', 'RinCMS\Admin\Controllers\DashboardController@show'],
    ['GET', '/admin/login', 'RinCMS\Admin\Controllers\LoginController@show'],
    ['POST', '/admin/login', 'RinCMS\Admin\Controllers\LoginController@login'],
    ['GET', '/admin/logout', 'RinCMS\Admin\Controllers\DashboardController@logout'],
];