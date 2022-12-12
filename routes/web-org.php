<?php
/*
    Route::get('/informeActividades/{cc}','informeContratistasController@informeActividades');
    Route::get('/homeInformeActividades/{cc}','informeContratistasController@homeInformeActividades');
    Route::post('/ModalRegistroInforme','informeContratistasController@ModalRegistroInforme');
    Route::get('/consultaCargoFuncionario','informeContratistasController@consultaCargoFuncionario');
    Route::post('/registroInformeEjecucion','informeContratistasController@registroInformeEjecucion');
    Route::post('/ModalEdicionInforme','informeContratistasController@ModalEdicionInforme');
    Route::post('/registroEdicionInformeEjecucion','informeContratistasController@registroEdicionInformeEjecucion');
    Route::get('/impresionInforme/{idInforme}/{internoOc?}','informeContratistasController@impresionInforme')->name('impresionInforme');
*/
Route::get('/consultaCargoFuncionario','informeContratistasController@consultaCargoFuncionario');

    //V3 INFORME CONTRATISTAS
    Route::get('/informeActividades/{cc}','informeContratistasController@informeActividades');
    Route::post('/datosContratoSeleccionado','informeContratistasController@datosContratoSeleccionado');
    Route::post('/datosDelContrato','informeContratistasController@datosDelContrato');
    Route::post('/ModalEdicionInformeV3','informeContratistasController@ModalEdicionInformeV3');
    Route::post('/registroEdicionInformeEjecucionV3','informeContratistasController@registroEdicionInformeEjecucionV3');
    Route::post('/ModalRegistroInformeV3','informeContratistasController@ModalRegistroInformeV3');
    Route::post('/registroInformeEjecucionV3','informeContratistasController@registroInformeEjecucionV3');
    

    