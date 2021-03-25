<?php

Route::get('/', function () {   return redirect('/login'); });
Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::group(['middleware' => 'auth'], function () { //Auth Users
    Route::get('/home', 'HomeController@index');
    Route::get('/elements_inventary/{id?}/move','ElementController@move_edit');
    Route::get('/elements_inventary/{id?}/diag_repair','ElementController@diag_repair');
    Route::post('/elements_movement','IncidentController@store');
    Route::get('/elements_movement','IncidentController@index');
    Route::resource('/element_diag_rapair','DiagnosticController');
    Route::get('/diag_repair','DiagnosticController@index');
    Route::resource('/maintenances','MaintenanceController');
    Route::get('/maintenances/{id?}/edit_comments','MaintenanceController@edit_Comments');
    Route::post('/maintenances/{id?}/comments','MaintenanceController@update_Comments');
    Route::resource('/documents','DocumentController');

    Route::get('/documents/{id?}/edit_comments','DocumentController@edit_Comments');
    
    Route::post('/documents/{id?}/comments','DocumentController@update_Comments');


    Route::get('/statistics','StatisticsController@index');
    Route::get('/certifications/{id}/edit_comments','CertificationController@edit_Comments');
    Route::post('/certifications/{id?}/comments','CertificationController@update_Comments');
    Route::resource('/certifications','CertificationController');
    
    
    Route::get('/new_contingency/{document_id}', 'ContingencyController@create');
    Route::resource('/contingencies','ContingencyController', ['except' => ['create']]);

//rutas para administrador y observador
    Route::resource('/stations','StationController');
    Route::get('/reports','ReportsController@index');
    Route::get('/list_certifications','CertificationController@listCertifications');
    Route::resource('/elements_inventary','ElementController');
    Route::post('/reports/maintenances','ReportsController@reportMaintenances');
    Route::post('/reports/elements','ReportsController@reportElements');
    Route::post('/reports/elements_nodiag','ReportsController@reportElementsNoDiag');
    Route::post('/reports/contingencies','ReportsController@reportContingencies');

    


  Route::group(['middleware' => 'company'], function () { //Rol Users == company

      Route::get('/list_elements','ElementController@listElements');
      Route::get('/assign_document','DocumentController@listAssingToMaintenance');
     // Route::get('/assign_document/{id?}','DocumentController@createAssignToMaintenance');
     // Route::post('/assign_document','DocumentController@saveAssingToMaintenance');
  });

  Route::group(['middleware' => 'admin'], function () {  //Rol Users == admin
     Route::resource('/activities','ActivityController');
     Route::resource('/periods','PeriodController');
     Route::resource('/users','UserController');
     Route::get('/element_of_station/{id?}','StationController@myElements');
     Route::post('/getCoordinates','StationController@getCoordinates');
     
     Route::post('/documents/{id?}/maintenances','DocumentController@update_DocumentMaintenances');

     Route::resource('/logs','LogController');
     Route::resource('/names','NameController');
     Route::resource('/types','TypeController');

  });

  Route::group(['middleware' => 'observer'], function () {


  });

});
