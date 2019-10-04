<?php

Route::get('/', 'PainelController@index')->name('index');
Route::get('/quote', 'PainelController@quote')->name('quote');