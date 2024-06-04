<?php

use App\Http\Middleware\AdminPanel;
use App\Http\Middleware\CheckSuperAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/pb','App\Http\Controllers\EmployeeController@index')->name('phoneBook');
Route::get('/login','App\Http\Controllers\HomeController@index')->name('login');

//main admin

Route::get('/ma/admins','App\Http\Controllers\AdminAccountingMAController@index')->name('ma.admins')->middleware(CheckSuperAdmin::class);
Route::post('/ma/admins','App\Http\Controllers\AdminAccountingMAController@create')->name('ma.admins.create')->middleware(CheckSuperAdmin::class);
//Route::get('/ma/admins/{admins}','App\Http\Controllers\AdminAccountingMAController@edit')->name('ma.admins.edit')->middleware(CheckSuperAdmin::class);
//Route::put('/ma/admins/{admins}','App\Http\Controllers\AdminAccountingMAController@update')->name('ma.admins.update')->middleware(CheckSuperAdmin::class);
Route::delete('/ma/admins/{admins}','App\Http\Controllers\AdminAccountingMAController@del')->name('ma.admins.del')->middleware(CheckSuperAdmin::class);


Route::get('/ma/employee','App\Http\Controllers\EmployeeMAController@index')->name('ma.employee')->middleware(CheckSuperAdmin::class);
Route::post('/ma/employee','App\Http\Controllers\EmployeeMAController@create')->name('ma.employee.create')->middleware(CheckSuperAdmin::class);
Route::get('/ma/employee/{employee}','App\Http\Controllers\EmployeeMAController@edit')->name('ma.employee.edit')->middleware(CheckSuperAdmin::class);
Route::put('/ma/employee/{employee}','App\Http\Controllers\EmployeeMAController@update')->name('ma.employee.update')->middleware(CheckSuperAdmin::class);
Route::delete('/ma/employee/{employee}','App\Http\Controllers\EmployeeMAController@del')->name('ma.employee.del')->middleware(CheckSuperAdmin::class);


Route::get('/ma/emp_status','App\Http\Controllers\EmployeeAbsenceMAController@index')->name('ma.emp_status')->middleware(CheckSuperAdmin::class);
Route::post('/ma/emp_status','App\Http\Controllers\EmployeeAbsenceMAController@create')->name('ma.emp_status.create')->middleware(CheckSuperAdmin::class);
Route::get('/ma/emp_status/{emp_status}','App\Http\Controllers\EmployeeAbsenceMAController@edit')->name('ma.emp_status.edit')->middleware(CheckSuperAdmin::class);
Route::put('/ma/emp_status/{emp_status}','App\Http\Controllers\EmployeeAbsenceMAController@update')->name('ma.emp_status.update')->middleware(CheckSuperAdmin::class);
Route::delete('/ma/emp_status/{emp_status}','App\Http\Controllers\EmployeeAbsenceMAController@del')->name('ma.emp_status.del')->middleware(CheckSuperAdmin::class);


Route::get('/ma/emp_accounting','App\Http\Controllers\EmployeeAccountingMAController@index')->name('ma.emp_accounting')->middleware(CheckSuperAdmin::class);
Route::post('/ma/emp_accounting','App\Http\Controllers\EmployeeAccountingMAController@create')->name('ma.emp_accounting.create')->middleware(CheckSuperAdmin::class);
Route::get('/ma/emp_accounting/{emp_accounting}','App\Http\Controllers\EmployeeAccountingMAController@edit')->name('ma.emp_accounting.edit')->middleware(CheckSuperAdmin::class);
Route::put('/ma/emp_accounting/{emp_accounting}','App\Http\Controllers\EmployeeAccountingMAController@update')->name('ma.emp_accounting.update')->middleware(CheckSuperAdmin::class);
Route::delete('/ma/emp_accounting/{emp_accounting}','App\Http\Controllers\EmployeeAccountingMAController@del')->name('ma.emp_accounting.del')->middleware(CheckSuperAdmin::class);


Route::get('/ma/structs','App\Http\Controllers\StructureMAController@index')->name('ma.structs')->middleware(CheckSuperAdmin::class);
Route::post('/ma/structs','App\Http\Controllers\StructureMAController@create')->name('ma.structs.create')->middleware(CheckSuperAdmin::class);
Route::get('/ma/structs/{structs}','App\Http\Controllers\StructureMAController@edit')->name('ma.structs.edit')->middleware(CheckSuperAdmin::class);
Route::put('/ma/structs/{structs}','App\Http\Controllers\StructureMAController@update')->name('ma.structs.update')->middleware(CheckSuperAdmin::class);
Route::delete('/ma/structs/{structs}','App\Http\Controllers\StructureMAController@del')->name('ma.structs.del')->middleware(CheckSuperAdmin::class);

Route::get('/ma/main_structs','App\Http\Controllers\MainStructureMAController@index')->name('ma.main_structs')->middleware(CheckSuperAdmin::class);
Route::post('/ma/main_structs','App\Http\Controllers\MainStructureMAController@create')->name('ma.main_structs.create')->middleware(CheckSuperAdmin::class);
Route::get('/ma/main_structs/{main_structs}','App\Http\Controllers\MainStructureMAController@edit')->name('ma.main_structs.edit')->middleware(CheckSuperAdmin::class);
Route::put('/ma/main_structs/{main_structs}','App\Http\Controllers\MainStructureMAController@update')->name('ma.main_structs.update')->middleware(CheckSuperAdmin::class);
Route::delete('/ma/main_structs/{main_structs}','App\Http\Controllers\MainStructureMAController@del')->name('ma.main_structs.del')->middleware(CheckSuperAdmin::class);


Route::get('/ma/posts','App\Http\Controllers\WorkingPostMAController@index')->name('ma.posts')->middleware(CheckSuperAdmin::class);
Route::post('/ma/posts','App\Http\Controllers\WorkingPostMAController@create')->name('ma.posts.create')->middleware(CheckSuperAdmin::class);
Route::get('/ma/posts/{posts}','App\Http\Controllers\WorkingPostMAController@edit')->name('ma.posts.edit')->middleware(CheckSuperAdmin::class);
Route::put('/ma/posts/{posts}','App\Http\Controllers\WorkingPostMAController@update')->name('ma.posts.update')->middleware(CheckSuperAdmin::class);
Route::delete('/ma/posts/{posts}','App\Http\Controllers\WorkingPostMAController@del')->name('ma.posts.del')->middleware(CheckSuperAdmin::class);


Route::get('/ma/statuses','App\Http\Controllers\StatusesMAController@index')->name('ma.statuses')->middleware(CheckSuperAdmin::class);
Route::post('/ma/statuses','App\Http\Controllers\StatusesMAController@create')->name('ma.statuses.create')->middleware(CheckSuperAdmin::class);
Route::get('/ma/statuses/{statuses}','App\Http\Controllers\StatusesMAController@edit')->name('ma.statuses.edit')->middleware(CheckSuperAdmin::class);
Route::put('/ma/statuses/{statuses}','App\Http\Controllers\StatusesMAController@update')->name('ma.statuses.update')->middleware(CheckSuperAdmin::class);
Route::delete('/ma/statuses/{statuses}','App\Http\Controllers\StatusesMAController@del')->name('ma.statuses.del')->middleware(CheckSuperAdmin::class);
// end main admin


//админка сотрудники

Route::get('/sa/employee','App\Http\Controllers\EmployeeSAController@index')->name('sa.employee')->middleware(AdminPanel::class);
Route::post('/sa/employee','App\Http\Controllers\EmployeeSAController@create')->name('sa.employee.create')->middleware(AdminPanel::class) ;
Route::get('/sa/employee/{employee}','App\Http\Controllers\EmployeeSAController@edit')->name('sa.employee.edit')->middleware(AdminPanel::class) ;
Route::put('/sa/employee/{employee}','App\Http\Controllers\EmployeeSAController@update')->name('sa.employee.update')->middleware(AdminPanel::class) ;
Route::delete('/sa/employee/{employee}','App\Http\Controllers\EmployeeSAController@del')->name('sa.employee.del')->middleware(AdminPanel::class) ;


//админка отделы

Route::get('/sa/structs','App\Http\Controllers\StructSAController@index')->name('sa.structs')->middleware(AdminPanel::class);
Route::post('/sa/structs','App\Http\Controllers\StructSAController@create')->name('sa.structs.create')->middleware(AdminPanel::class) ;
Route::get('/sa/structs/{structs}','App\Http\Controllers\StructSAController@edit')->name('sa.structs.edit')->middleware(AdminPanel::class) ;
Route::put('/sa/structs/{structs}','App\Http\Controllers\StructSAController@update')->name('sa.structs.update')->middleware(AdminPanel::class) ;
Route::delete('/sa/structs/{structs}','App\Http\Controllers\StructSAController@del')->name('sa.structs.del')->middleware(AdminPanel::class) ;


//админка сотрудники-статусы

Route::get('/sa/status','App\Http\Controllers\StatusSAController@index')->name('sa.status')->middleware(AdminPanel::class);
Route::get('/sa/status/{employee}','App\Http\Controllers\StatusSAController@edit')->name('sa.status.edit') ->middleware(AdminPanel::class);
Route::put('/sa/status/{employee}','App\Http\Controllers\StatusSAController@update')->name('sa.status.update') ->middleware(AdminPanel::class);



Route::get('/sa/accounting','App\Http\Controllers\AccountingSAController@index')->name('sa.accounting')->middleware(AdminPanel::class);
Route::post('/sa/accounting','App\Http\Controllers\AccountingSAController@create')->name('sa.accounting.create')->middleware(AdminPanel::class);

Route::get('/pb/seed','App\Http\Controllers\EmployeeController@seedTestData');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
