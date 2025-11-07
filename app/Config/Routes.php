<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Routes untuk Login
$routes->get('/', 'AuthController::welcome'); // Welcome page
$routes->get('login', 'AuthController::index'); // Login page
$routes->post('login', 'AuthController::login'); // Login process
$routes->get('logout', 'AuthController::logout'); // Logout

// Routes untuk Profile Admin
$routes->group('PROFILE ADMIN/profile', function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->get('edit/(:num)', 'ProfileController::edit/$1');
    $routes->post('update', 'ProfileController::update');
});

// Routes untuk Home (DASHBOARD)
$routes->get('DOCUMENTATION IT/dashboard/home', 'Home::index'); // Halaman utama admin

// Routes untuk Helpdesk Admin
$routes->group('DOCUMENTATION IT/helpdesk', function ($routes) {
    $routes->get('helpdesk-admin', 'HelpdeskController::helpdesk'); // Halaman Admin
    $routes->get('create', 'HelpdeskController::create'); // Form Tambah Tiket
    $routes->post('store', 'HelpdeskController::store'); // Proses Simpan Tiket
    $routes->get('edit(:num)', 'HelpdeskController::edit/$1'); // Form Edit Tiket
    $routes->post('update/(:segment)', 'HelpdeskController::update/$1'); // Proses Update Tiket
    $routes->get('delete/(:num)', 'HelpdeskController::delete/$1'); // Proses Hapus Tiket
});

$routes->group('DOCUMENTATION IT/invoice', function ($routes) {
    $routes->get('bill', 'InvoiceController::index'); // Daftar Invoice
    $routes->get('create', 'InvoiceController::create'); // Form Create Invoice
    $routes->post('save', 'InvoiceController::save');   // Simpan Invoice
    $routes->get('edit/(:num)', 'InvoiceController::edit/$1'); // Edit Invoice
    $routes->post('update/(:num)', 'InvoiceController::update/$1'); // Update Invoice
    $routes->get('delete/(:num)', 'InvoiceController::delete/$1'); // Update Invoice
});

// Routes untuk Employee 
$routes->group('ORGANIZE/employee', function ($routes) {
    $routes->get('new', 'EmployeeController::new'); // Form tambah employee
    $routes->post('save', 'EmployeeController::save'); // Simpan employee baru
    $routes->get('edit/(:segment)', 'EmployeeController::edit/$1'); // Form edit
    $routes->post('update/(:segment)', 'EmployeeController::update/$1'); // Update employee
    $routes->get('exit', 'EmployeeController::exit'); // Form exit employee
    $routes->post('submit', 'EmployeeController::submit'); // Proses exit employee
});

// Routes untuk PIC 
$routes->group('ORGANIZE/pic', function ($routes) {
    $routes->get('pic-IT', 'PicController::index');
    $routes->get('create', 'PicController::create');
    $routes->post('store', 'PicController::store');
    $routes->get('edit/(:segment)', 'PicController::edit/$1');
    $routes->post('pic-IT/updateStatus/(:num)', 'PicController::updateStatus/$1');
    $routes->post('delete/(:segment)', 'PicController::delete/$1');
});

// Routes untuk Category
$routes->group('TASK/categories', function ($routes) {
    $routes->get('category', 'CategoryController::index'); // Daftar Kategori
    $routes->post('store', 'CategoryController::store'); // Simpan Kategori
    $routes->get('edit-category/(:num)', 'CategoryController::edit/$1'); // Form Edit Kategori
    $routes->post('update/(:num)', 'CategoryController::update/$1'); // Update Kategori
    $routes->post('delete/(:num)', 'CategoryController::delete/$1'); // Hapus Kategori
});

// Routes untuk Subcategory
$routes->group('TASK/subcategories', function ($routes) {
    $routes->get('subcategory', 'SubcategoryController::index'); // Daftar Subkategori
    $routes->get('create', 'SubcategoryController::create'); // Tambah Subkategori
    $routes->post('store', 'SubcategoryController::store'); // Simpan Subkategori
    $routes->get('edit-subcategory/(:segment)', 'SubcategoryController::edit/$1');
    $routes->post('update/(:segment)', 'SubcategoryController::update/$1');
    $routes->post('delete/(:segment)', 'SubcategoryController::delete/$1');
});

// Routes untuk Department 
$routes->group('TASK/departments', function ($routes) {
    $routes->get('department-company', 'DepartmentController::index');
    $routes->get('create', 'DepartmentController::create');
    $routes->post('store', 'DepartmentController::store');
    $routes->get('edit-department/(:segment)', 'DepartmentController::edit/$1');
    $routes->post('update/(:segment)', 'DepartmentController::update/$1');
    $routes->post('delete/(:segment)', 'DepartmentController::delete/$1');
});

// Routes untuk ADMIN
$routes->group('ACCOUNT MANAGER/admin', function ($routes) {
    $routes->get('admin-manager', 'AdminManagerController::index');
    $routes->get('create', 'AdminManagerController::create');
    $routes->post('store', 'AdminManagerController::store');
    $routes->get('edit/(:num)', 'AdminManagerController::edit/$1');
    $routes->post('update/(:num)', 'AdminManagerController::update/$1');
    $routes->get('delete/(:num)', 'AdminManagerController::delete/$1');
});

// Routes untuk PIC
$routes->group('ACCOUNT MANAGER/pic', function ($routes) {
    $routes->get('pic-manager', 'PicManagerController::index');
    $routes->get('create-pic-manager', 'PicManagerController::create');
    $routes->post('store', 'PicManagerController::store');
    $routes->get('edit-pic-manager/(:num)', 'PicManagerController::edit/$1');
    $routes->post('update/(:num)', 'PicManagerController::update/$1');
    $routes->get('delete/(:num)', 'PicManagerController::delete/$1');
});

// Routes untuk USER   
$routes->group('ACCOUNT MANAGER/user', function ($routes) {
    $routes->get('user-manager', 'UserManagerController::index'); // Halaman utama User Manager
    $routes->get('create', 'UserManagerController::create'); // Form tambah user
    $routes->post('store', 'UserManagerController::store'); // Simpan user baru
    $routes->get('edit/(:segment)', 'UserManagerController::edituser/$1'); // Form edit user
    $routes->post('update/(:segment)', 'UserManagerController::update/$1'); // Update user
    $routes->post('delete/(:segment)', 'UserManagerController::delete/$1'); // Hapus user
});

// Routes untuk Group Manager  
$routes->group('ACCOUNT MANAGER/group', function ($routes) {
    $routes->get('group-manager', 'GroupManagerController::index'); // Halaman utama Group Manager
    $routes->get('view-members/(:num)', 'GroupManagerController::viewMembers/$1'); // Lihat anggota group
    $routes->get('create', 'GroupManagerController::create'); // Form tambah group
    $routes->post('group-manager/store', 'GroupManagerController::store'); // Simpan group baru
    $routes->get('edit/(:num)', 'GroupManagerController::edit/$1'); // Form edit group
    $routes->post('group-manager/save/(:num)', 'GroupManagerController::save/$1'); // Simpan perubahan group
    $routes->get('edit/remove-member/(:num)/(:num)', 'GroupManagerController::removeMember/$1/$2'); // Hapus anggota dari group
    $routes->post('edit/add-member', 'GroupManagerController::addMember'); // Tambah anggota ke group (AJAX)
    $routes->get('detail/(:num)', 'GroupManagerController::detail/$1'); // Detail group
    $routes->get('delete/(:num)', 'GroupManagerController::delete/$1'); // Hapus group
});

// Routes untuk Status Pic
$routes->group('ACCOUNT MANAGER/about', function ($routes) {
    $routes->get('status', 'StatusController::index'); // Menampilkan halaman profil PIC
    $routes->post('upload', 'ProfileUserController::uploadProfilePicture'); // Upload foto profil PIC
});

// Routes untuk Helpdesk User
$routes->group('USER/helpdesk', function ($routes) {
    $routes->get('helpdesk-user', 'HelpdeskUserController::helpdesk'); // Daftar Tiket User
    $routes->get('create', 'HelpdeskUserController::create'); // Form Tambah Tiket User
    $routes->post('store', 'HelpdeskUserController::store'); // Proses Simpan Tiket User
    $routes->get('edit/(:num)', 'HelpdeskUserController::edit/$1'); // Form Edit Tiket User
    $routes->post('update/(:segment)', 'HelpdeskUserController::update/$1'); // Proses Update Tiket User
    $routes->get('delete/(:num)', 'HelpdeskUserController::delete/$1'); // Proses Hapus Tiket User
});

// Routes untuk Profile User
$routes->group('PROFILE USER', ['filter' => 'auth'], function ($routes) {
    $routes->get('profile', 'ProfileUserController::user', ['as' => 'profile.user']); // Menampilkan profil
    $routes->get('edit', 'ProfileUserController::edit', ['as' => 'profile.user.edit']); // Halaman edit profil
    $routes->post('update', 'ProfileUserController::updateuser', ['as' => 'profile.user.update']); // Update profil
    $routes->post('upload', 'ProfileUserController::uploadProfilePicture', ['as' => 'profile.user.upload']); // ✅ Perbaikan disini
});

// Routes untuk Profile PIC
$routes->group('PROFILE PIC', ['filter' => 'auth'], function ($routes) {
    $routes->get('profile', 'ProfilePicController::index', ['as' => 'profile.pic']);
    $routes->get('edit/(:num)', 'ProfilePicController::edit/$1', ['as' => 'profile.pic.edit']);
    $routes->post('update', 'ProfilePicController::update', ['as' => 'profile.pic.update']);
    $routes->post('upload', 'ProfilePicController::uploadProfilePicture', ['as' => 'profile.pic.upload']); // ✅ Perbaikan disini
});

// Routes untuk Dashboard PIC
$routes->get('PROGRESS TRACK/dashboard/home', 'HomePic::index', ['filter' => 'auth']);

// Routes untuk Helpdesk PIC
$routes->group('PROGRESS TRACK/helpdesk', function ($routes) {
    $routes->get('helpdesk-pic', 'HelpdeskPicController::helpdesk'); // Halaman Admin
    $routes->get('create', 'HelpdeskPicController::create'); // Form Tambah Tiket
    $routes->post('store', 'HelpdeskPicController::store'); // Proses Simpan Tiket
    $routes->get('edit/(:num)', 'HelpdeskPicController::edit/$1'); // Form Edit Tiket
    $routes->post('update/(:segment)', 'HelpdeskPicController::update/$1'); // Proses Update Tiket
    $routes->get('delete/(:num)', 'HelpdeskPicController::delete/$1'); // Proses Hapus Tiket
});

// Routes untuk Authentication (Register & Forgot Password)
$routes->group('AUTH', function ($routes) {
    $routes->get('register', 'AuthController::register', ['as' => 'auth.register']); // Halaman Register
    $routes->post('register', 'AuthController::processRegister'); // Proses Register
    $routes->get('forgot-password', 'AuthController::forgotPassword', ['as' => 'auth.forgot']); // Halaman Lupa Password
    $routes->post('forgot-password', 'AuthController::processForgotPassword'); // Proses Reset Password
});

// Routes untuk PIC User
$routes->group('EMPLOYEE/pic', ['filter' => 'auth'], function ($routes) {
    $routes->get('pic-IT', 'PicUserController::index'); // Menampilkan daftar PIC
    $routes->post('store', 'PicUserController::store'); // Menyimpan PIC baru
    $routes->get('delete/(:num)', 'PicUserController::delete/$1'); // Menghapus PIC
    $routes->post('update-status/(:num)', 'PicUserController::updateStatus/$1'); // Update status PIC via AJAX
});

// Routes untuk Group PIC
$routes->group('EMPLOYEE/group', ['filter' => 'auth'], function ($routes) {
    $routes->get('group-pic', 'GroupPICController::index'); // Menampilkan daftar grup PIC
    $routes->get('create-group', 'GroupPICController::create'); // Halaman form tambah grup
    $routes->post('store', 'GroupPICController::store'); // Menyimpan grup baru
    $routes->get('edit-group/(:num)', 'GroupPICController::edit/$1'); // Halaman edit grup
    $routes->post('save/(:num)', 'GroupPICController::save/$1'); // Menyimpan perubahan grup
    $routes->get('view-members/(:num)', 'GroupPICController::viewMembers/$1'); // Melihat anggota grup
    $routes->post('add-member', 'GroupPICController::addMember'); // Menambahkan anggota ke grup
    $routes->get('remove-member/(:num)/(:num)', 'GroupPICController::removeMember/$1/$2'); // Menghapus anggota grup
    $routes->get('detail/(:num)', 'GroupPICController::detail/$1'); // Detail grup
    $routes->get('delete/(:num)', 'GroupPICController::delete/$1'); // Menghapus grup
});

// Routes untuk Notifications
$routes->group('notifications', function ($routes) {
    $routes->get('get-admin', 'NotificationController::getNotifications'); // Ambil notifikasi berdasarkan admin_id
    $routes->get('fetch', 'NotificationController::fetchNotifications'); // Ambil notifikasi + jumlah unread
    $routes->post('mark-read/(:num)', 'NotificationController::markAsRead/$1'); // Tandai notifikasi sebagai terbaca
    $routes->post('mark-all-as-read', 'NotificationController::markAllAsRead'); // Tandai semua notifikasi sebagai terbaca
});

$routes->post('helpdesk/rateTicket', 'HelpdeskUserController::rateTicket');
$routes->get('helpdesk/getRating/(:num)', 'HelpdeskUserController::getRating/$1');

$routes->get('notificationcontroller/get_notifications', 'NotificationController::get_notifications');
$routes->get('get-session-user', 'AuthController::getSessionUser');
$routes->post('profile/upload', 'ProfileController::uploadProfilePicture'); // Untuk admin
$routes->post('profile/upload', 'ProfileUserController::uploadProfilePicture'); // Untuk user

$routes->get('/ACCOUNT MANAGER/rating/star', 'StarController::index');
$routes->get('star/average-pic', 'StarController::averagePerPic');
$routes->get('ACCOUNT MANAGER/reward/achievement', 'AchievementController::index');
$routes->get('star/average-time-per-pic', 'StarController::averageTimePerPic');

$routes->get('ACCOUNT MANAGER/progress/tracking', 'TrackingController::index');
$route['ACCOUNT MANAGER/progress/tracking'] = 'TrackingController/index';

$routes->get('/language/change/(:segment)', 'LanguageController::changeLanguage/$1');
$routes->get('ACCOUNT MANAGER/activity/history', 'ActivityLogController::index');
$routes->post('ACCOUNT MANAGER/activity/history/autoDeleteOldLogs', 'ActivityLogController::autoDeleteOldLogs');
$routes->post('ACCOUNT MANAGER/activity/history/fetch', 'ActivityLogController::fetch', ['as' => 'activity.fetch']);
$routes->get('uploads/(:any)', 'DownloadController::download/$1');
$routes->get('ORGANIZE/employee/history', 'HistoryController::index');
