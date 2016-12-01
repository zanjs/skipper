<?php

Route::get('login', ['uses' => 'SkipperAuthController@login', 'as' => 'skipper.login'])->middleware('web');
Route::post('login', 'SkipperAuthController@postLogin')->middleware('web');

Route::group(['middleware' => ['web', 'admin.user']], function () {

    // Main Admin and Logout Route
    Route::get('/', ['uses' => 'SkipperController@index', 'as' => 'skipper.dashboard']);
    Route::get('logout', ['uses' => 'SkipperController@logout', 'as' => 'skipper.logout']);
    Route::post('upload', ['uses' => 'SkipperController@upload', 'as' => 'skipper.upload']);

    Route::get('profile', [
        'as' => 'skipper.profile',
        function () {
            return view('skipper::profile');
        },
    ]);

    if (env('DB_CONNECTION') !== null && Schema::hasTable('data_types')):
        foreach (Anla\Skipper\Models\DataType::all() as $dataTypes):
            Route::resource($dataTypes->slug, 'SkipperBreadController');
    endforeach;
    endif;

    // Menu Routes
    Route::get('menus/{id}/builder/', ['uses' => 'SkipperMenuController@builder', 'as' => 'skipper.menu.builder']);
    Route::delete('menu/delete_menu_item/{id}',
        ['uses' => 'SkipperMenuController@delete_menu', 'as' => 'skipper.menu.delete_menu_item']);
    Route::post('menu/add_item', ['uses' => 'SkipperMenuController@add_item', 'as' => 'skipper.menu.add_item']);
    Route::put('menu/update_menu_item',
        ['uses' => 'SkipperMenuController@update_item', 'as' => 'skipper.menu.update_menu_item']);
    Route::post('menu/order', ['uses' => 'SkipperMenuController@order_item', 'as' => 'skipper.menu.order_item']);

    // Settings
    Route::get('settings', ['uses' => 'SkipperSettingsController@index', 'as' => 'skipper.settings']);
    Route::post('settings', 'SkipperSettingsController@save');
    Route::post('settings/create', ['uses' => 'SkipperSettingsController@create', 'as' => 'skipper.settings.create']);
    Route::delete('settings/{id}', ['uses' => 'SkipperSettingsController@delete', 'as' => 'skipper.settings.delete']);
    Route::get('settings/move_up/{id}',
        ['uses' => 'SkipperSettingsController@move_up', 'as' => 'skipper.settings.move_up']);
    Route::get('settings/move_down/{id}',
        ['uses' => 'SkipperSettingsController@move_down', 'as' => 'skipper.settings.move_down']);
    Route::get('settings/delete_value/{id}',
        ['uses' => 'SkipperSettingsController@delete_value', 'as' => 'skipper.settings.delete_value']);

    // Admin Media
    Route::get('media', ['uses' => 'SkipperMediaController@index', 'as' => 'skipper.media']);
    Route::post('media/files', 'SkipperMediaController@files');
    Route::post('media/new_folder', 'SkipperMediaController@new_folder');
    Route::post('media/delete_file_folder', 'SkipperMediaController@delete_file_folder');
    Route::post('media/directories', 'SkipperMediaController@get_all_dirs');
    Route::post('media/move_file', 'SkipperMediaController@move_file');
    Route::post('media/rename_file', 'SkipperMediaController@rename_file');
    Route::post('media/upload', ['uses' => 'SkipperMediaController@upload', 'as' => 'skipper.media.upload']);

    // Database Routes
    Route::get('database', ['uses' => 'SkipperDatabaseController@index', 'as' => 'skipper.database']);
    Route::get('database/create-table',
        ['uses' => 'SkipperDatabaseController@create', 'as' => 'skipper.database.create_table']);
    Route::post('database/create-table', 'SkipperDatabaseController@store');
    Route::get('database/table/{table}',
        ['uses' => 'SkipperDatabaseController@table', 'as' => 'skipper.database.browse_table']);
    Route::delete('database/table/delete/{table}', 'SkipperDatabaseController@delete');
    Route::get('database/edit-{table}-table',
        ['uses' => 'SkipperDatabaseController@edit', 'as' => 'skipper.database.edit_table']);
    Route::post('database/edit-{table}-table', 'SkipperDatabaseController@update');

    Route::post('database/create_bread',
        ['uses' => 'SkipperDatabaseController@addBread', 'as' => 'skipper.database.create_bread']);
    Route::post('database/store_bread',
        ['uses' => 'SkipperDatabaseController@storeBread', 'as' => 'skipper.database.store_bread']);
    Route::get('database/{id}/edit-bread',
        ['uses' => 'SkipperDatabaseController@addEditBread', 'as' => 'skipper.database.edit_bread']);
    Route::put('database/{id}/edit-bread', 'SkipperDatabaseController@updateBread');
    Route::delete('database/delete_bread/{id}',
        ['uses' => 'SkipperDatabaseController@deleteBread', 'as' => 'skipper.database.delete_bread']);
});
