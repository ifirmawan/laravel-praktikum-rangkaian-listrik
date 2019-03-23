<?php

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

Route::get('/', 'AuthController@home')->name('site.index')->middleware('auth');

//Route::get('/admin/aktivitas', 'Admin\AktivitasController@index')->name('admin.aktivitas');
//Route::get('/admin/aktivitas/tambah', 'Admin\AktivitasController@add')->name('admin.aktivitas.add');
//Route::get('/admin/aktivitas/ubah/{id_aktivitas}', 'Admin\AktivitasController@edit')->name('admin.aktivitas.edit');
//Route::post('/admin/aktivitas/store', 'Admin\AktivitasController@store')->name('admin.aktivitas.store');
//Route::post('/admin/aktivitas/update/{id_aktivitas}', 'Admin\AktivitasController@update')->name('admin.aktivitas.update');
//Route::delete('/admin/aktivitas/delete/{id_aktivitas}', 'Admin\AktivitasController@destroy')->name('admin.aktivitas.destroy');
//
//Route::get('/admin/matkul', 'Admin\MatkulController@add')->name('admin.matkul.add');
//Route::get('/admin/matkul/ubah/{id}', 'Admin\MatkulController@edit')->name('admin.matkul.edit');
//Route::post('/admin/matkul/store', 'Admin\MatkulController@store')->name('admin.matkul.store');
//Route::post('/admin/matkul/update/{id}', 'Admin\MatkulController@update')->name('admin.matkul.update');
//Route::delete('/admin/matkul/delete/{id}', 'Admin\MatkulController@destroy')->name('admin.matkul.destroy');
//
//Route::get('/admin/kelas', 'Admin\KelasController@add')->name('admin.kelas.add');
//Route::get('/admin/kelas/ubah/{id}', 'Admin\KelasController@edit')->name('admin.kelas.edit');
//Route::post('/admin/kelas/store', 'Admin\KelasController@store')->name('admin.kelas.store');
//Route::post('/admin/kelas/update/{id}', 'Admin\KelasController@update')->name('admin.kelas.update');
//Route::delete('/admin/kelas/delete/{id}', 'Admin\KelasController@destroy')->name('admin.kelas.destroy');
//
//Route::get('/admin/pengguna', 'Admin\UserController@pengguna')->name('admin.pengguna');
//Route::delete('/admin/pengguna/delete/{id_user}', 'Admin\UserController@destroy')->name('admin.pengguna.destroy');
//
//Route::get('/admin/peserta', 'Admin\PesertaController@index')->name('admin.peserta');


Route::group(['middleware' => ['guest']], function()
{
    Route::get('/login', 'AuthController@login')->name('site.login');
    Route::post('/login', 'AuthController@authenticate')->name('site.authenticate');
    Route::get('/register', 'AuthController@registerForm')->name('site.register');
    Route::post('/mahasiswa/register', 'AuthController@register')->name('mahasiswa.register');

});

Route::get('/logout', 'AuthController@logout')->name('site.logout');

Route::group(['middleware' => ['mahasiswa']], function() {
    Route::get('/index', 'Mahasiswa\ModulController@index')->name('mahasiswa.index');
    Route::get('/profil', 'Mahasiswa\ModulController@profil')->name('mahasiswa.profil');
    Route::post('/profil/save', 'Mahasiswa\ModulController@saveProfile')->name('mahasiswa.profil.save');

    Route::get('/kelas', 'Mahasiswa\ModulController@kelas')->name('mahasiswa.kelas');
    Route::post('/kelas/join/{id_aktivitas}', 'Mahasiswa\ModulController@joinClass')->name('mahasiswa.kelas.join');

    Route::get('/matkul/{id_aktivitas}', 'Mahasiswa\ModulController@showMatkul')->name('mahasiswa.matkul');
    Route::get('/matkul/{id_aktivitas}/peserta', 'Mahasiswa\ModulController@peserta')->name('mahasiswa.matkul.peserta');
    Route::get('/matkul/{id_aktivitas}/modul/{id_modul}', 'Mahasiswa\ModulController@showModul')->name('mahasiswa.modul.view');
    Route::get('/matkul/{id_aktivitas}/modul/{id_modul}/edit', 'Mahasiswa\ModulController@editResume')->name('mahasiswa.modul.edit');


    Route::post('/resume/submit/{id_aktivitas}/{id_modul}', 'Mahasiswa\ModulController@storeResume')->name('mahasiswa.submit.resume');
    Route::post('/resume/edit/{id_aktivitas}/{id_modul}', 'Mahasiswa\ModulController@updateResume')->name('mahasiswa.edit.resume');
    Route::delete('/resume/delete/{id_aktivitas}/{id_modul}', 'Mahasiswa\ModulController@deleteResume')->name('mahasiswa.delete.resume');
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//
//Route::get('/import', function()
//{
//
//    $row = 1;
//    $anu = public_path('anu.csv');
//    if (($handle = fopen("anu.csv", "r")) !== FALSE) {
//        while (($data = fgetcsv($handle, 194, ",")) !== FALSE) {
//            $num = count($data);
//            echo "<p> $num fields in line $row: <br /></p>\n";
//            $row++;
//            for ($c=0; $c < $num; $c++) {
//                echo $data[$c] . "<br />\n";
//
//                if (\App\User::where('NIM', $data[0])->count()==0)
//                {
//                    $user = new \App\User;
//                    $user->NIM = $data[0];
//                    $user->name = $data[1];
//                    $user->email = $data[0].'@ittelkom-pwt.ac.id';
//                    $user->password = \Illuminate\Support\Facades\Hash::make($data[0]);
//                    $user->role = '3';
//
//                    $sourceFilePath=public_path()."/img/avatar/default.png";
//                    $filename = $data[0].'_'.rand(0,9999).'.png';
//                    $destinationPath=public_path()."/img/avatar/".$filename;
//                    $success = \File::copy($sourceFilePath,$destinationPath);
//
//                    $user->photo = $filename;
//                    $user->save();
//
//                    $peserta = new \App\Peserta;
//                    $peserta->id_user = $user->id;
//                    $peserta->id_aktivitas = $data[2];
//                    $peserta->save();
//                }
//
//            }
//        }
//        fclose($handle);
//    }
//
//});
//
//Route::get('/asis', function()
//{
//
//    $row = 1;
//    $anu = public_path('jos.csv');
//    if (($handle = fopen("jos.csv", "r")) !== FALSE) {
//        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//            $num = count($data);
//            echo "<p> $num fields in line $row: <br /></p>\n";
//            $row++;
//            for ($c=0; $c < $num; $c++) {
//                echo $data[$c] . "<br />\n";
//
//                if (\App\User::where('NIM', $data[0])->count()==0)
//                {
//                    $user = new \App\User;
//                    $user->NIM = $data[0];
//                    $user->name = $data[1];
//                    $user->email = $data[0].'@ittelkom-pwt.ac.id';
//                    $user->password = \Illuminate\Support\Facades\Hash::make($data[0]);
//                    $user->role = '2';
//                    $user->is_asisten = '1';
//
//                    $sourceFilePath=public_path()."/img/avatar/default.png";
//                    $filename = $data[0].'_'.rand(0,9999).'.png';
//                    $destinationPath=public_path()."/img/avatar/".$filename;
//                    $success = \File::copy($sourceFilePath,$destinationPath);
//
//                    $user->photo = $filename;
//                    $user->save();
//
//                    for ($i=1; $i<=6; $i++)
//                    {
//                        $peserta = new \App\Peserta;
//                        $peserta->id_user = $user->id;
//                        $peserta->id_aktivitas = $i;
//                        $peserta->save();
//                    }
//
//                }
//
//            }
//        }
//        fclose($handle);
//    }
//
//});
//
//Route::get('/jos', function()
//{
//    for ($i=1; $i<=6; $i++)
//    {
//        $anu = ['350', '364', '368'];
//        for ($a=0; $a<3; $a++)
//        {
//            $peserta = new \App\Peserta;
//            $peserta->id_user = $anu[$a];
//            $peserta->id_aktivitas = $i;
//            $peserta->save();
//        }
//    }
//});