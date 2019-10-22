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

use LaravelDoctrine\ORM\Facades\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entities\Task;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/add', function(EntityManagerInterface $em){
    $task = new App\Entities\Task('Make test app', 'Create the test application for the Sitepoint article.');

    $em->persist($task);
    $em->flush();

    return 'Added!';
});

Route::get('/find', function(EntityManagerInterface $em){
    $task = $em->find(Task::class, 1);

    return $task->getName().' - '.$task->getDescription();
}); */

Route::resource('tasks', 'TasksController');
Route::get('/tasks/{task}/toggle', 'TasksController@toggleStatus');

Route::group(['middleware' => ['web']], function() {
    Route::get('test-user', function(\Doctrine\ORM\EntityManagerInterface $em) {
        $user = new \App\Entities\User('Nathan', 'nathan@domi.nio');
        $user->setPassword(bcrypt('123456'));

        $em->persist($user);
        $em->flush();
    });

    Route::get('/login', function() {
        return view('login');
    });

    Route::post('/login', function() {
        if (\Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            return redirect('/');
        }
    });

    Route::get('logout', function() {
        \Auth::logout();
        return redirect('login');
    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', 'TasksController@index');
    });
});
