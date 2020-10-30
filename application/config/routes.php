<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['admin/design/(:num)'] = 'admin/design';
$route['admin'] = 'admin/dashboard';
$route['get_fabric'] = 'admin/dashboard/get_fabric';

// $route['associate_members'] = 'home/associate_members';
// $route['associate_members'] = 'home/associate_members';
// $route['governing_council_members'] = 'home/governing_council_members';
// $route['mission'] = 'home/mission';
// $route['our_promters'] = 'home/our_promters';
// $route['our_team'] = 'home/our_team';
// $route['vision'] = 'home/vision';
// $route['unemployed_candidate_registration'] = 'home/unemployed_candidate_registration';
// $route['training_partner_registration'] = 'home/training_partner_registration';
// $route['indentrepreneurshipdevelopmentprograms'] = 'home/indentrepreneurshipdevelopmentprograms';
// $route['careerpaths'] = 'home/careerpaths';
// $route['recognisedpriorlearning'] = 'home/recognisedpriorlearning';
// $route['worldskillsindia'] = 'home/worldskillsindia';
// $route['ytdeled'] = 'home/ytdeled';
// $route['ytdeved'] = 'home/ytdeved';
// $route['setprograms'] = 'home/setprograms';
// $route['companytrainingprograms'] = 'home/companytrainingprograms';
// $route['govtrainingpragrams'] = 'home/govtrainingpragrams';
// $route['trainingmaterials'] = 'home/trainingmaterials';
// $route['pvtsectortrainingprograms'] = 'home/pvtsectortrainingprograms';
// $route['interactive'] = 'home/interactive';
// $route['trainingtools'] = 'home/trainingtools';
// $route['news_events'] = 'home/news_events';
// $route['industrypartnersmembership'] = 'home/industrypartnersmembership';
// $route['individualmembership'] = 'home/individualmembership';
// $route['trainingpartners'] = 'home/trainingpartners';
// $route['assessmentpartners'] = 'home/assessmentpartners';
// $route['knowledgepartners'] = 'home/knowledgepartners';
// $route['strategicpartners'] = 'home/strategicpartners';
// $route['contact'] = 'home/contact';
// $route['termandcondition'] = 'home/termandcondition';
// $route['privacy_policy'] = 'home/privacy_policy';
// $route['service'] = 'home/service';
