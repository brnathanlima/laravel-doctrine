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
