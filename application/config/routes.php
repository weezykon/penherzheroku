<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "auth";
$route['404_override'] = '';
$route['office'] = 'auth/registeroffice';
$route['page'] = 'auth/registerpage';
$route['register'] = 'auth/registeruser';
$route['logout'] = 'auth/logout';
$route['login'] = 'auth/login';
$route['follow'] = 'follow';
$route['profile'] = 'profile';
$route['message'] = 'message';
$route['story/insert'] = 'stories/insert';
$route['story/delete'] = 'stories/delete';
$route['story/report'] = 'stories/report';
$route['story/love'] = 'stories/love';
$route['story/user'] = 'stories/user';
$route['story/singlestory'] = 'stories/single_story';
$route['comment'] = 'stories/comment';
$route['savestory'] = 'stories/savestory';
$route['storiessaved'] = 'stories/fetchsavedstories';
$route['timeline'] = 'timeline';
$route['follow'] = 'follow';
$route['followers'] = 'follow/followers';
$route['following'] = 'follow/following';
$route['publicnotes'] = 'note/publicnotes';
$route['allnotes'] = 'note/all';
$route['deletenote'] = 'note/deletenote';
$route['addnote'] = 'note/addnote';
$route['editnote'] = 'note/editnote';
$route['note'] = 'note/fetchnote';
$route['social'] = 'profile/social';
$route['hours'] = 'profile/hours';
$route['addbooks'] = 'profile/bookswritten';
$route['updateprofile'] = 'profile/updateprofile';
$route['notifications'] = 'notification';
$route['checknotification'] = 'notification/checknew';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
