<?php

use Illuminate\Http\Request;
use Nwidart\Modules\Laravel\Module;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix(Module::currentConfig('slug'))->group(function () {
    Route::get('/', 'TemplatesController@view_index');
    // Route::get('/', function (Request $request) {
    //     $templates = app('files')->directories(module_path(Module::currentConfig('name'), config('modules.paths.generator.views.path') . '\\templates'));
    //     var_dump($templates);
    // });
    Route::get('/{path}', 'TemplatesController@view_templates')->where(['path' => '.*']);
});
