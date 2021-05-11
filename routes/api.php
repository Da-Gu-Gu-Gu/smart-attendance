<?php
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('student', StudentController::class); // dr ka ma ti buu pyn pyin ya ml
// Route::post('student',[StudentController::class,'store']);

//student
Route::post('login/student',[LoginController::class,'loginStudent']);
Route::post('register/student',[LoginController::class,'registerStudent']);
Route::post('forgetpassword/student',[LoginController::class,'forgetpasswordstudent']);
Route::post('spreset',[LoginController::class,'spreset']);
Route::post('sprofile_edit',[LoginController::class,'sprofile_edit']);


//teacher
Route::post('login/teacher',[LoginController::class,'loginteacher']);
Route::post('forgetpassord/teacher',[LoginController::class,'forgetpasswordteacher']);
Route::post('tpreset',[LoginController::class,'tpreset']);

//rollcall
Route::post('rollcall',[LoginController::class,'rollcall']);

//profile
Route::post('tprofile_edit',[LoginController::class,'tprofile_edit']);

// event
Route::post('event',[LoginController::class,"calendarevent"]);

// assignment
Route::post('assignment',[LoginController::class,"assignment"]);

Route::post('assanswer',[LoginController::class,"assanswer"]);



