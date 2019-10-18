<?php

namespace App\Http\Controllers;

use App\Entities\Task;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EntityManagerInterface $em)
    {
        $tasks = $em->getRepository(Task::class)->findAll();

        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EntityManagerInterface $em)
    {
        $task = new Task(
            request('name'),
            request('description')
        );

        $em->persist($task);
        $em->flush();

        return redirect('/tasks/create')->with([
            'success_message' => 'Task added successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, EntityManagerInterface $em)
    {
        $task = $em->getRepository(Task::class)->find($id);

        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, EntityManagerInterface $em)
    {
        $task = $em->getRepository(Task::class)->find($id);

        $task->setName(request('name'));
        $task->setDescription(request('description'));

        $em->flush();

        return redirect('/tasks/'.$task->getId().'/edit')->with('success_message', 'Task modified successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, EntityManagerInterface $em)
    {
        $task = $em->getRepository(Task::class)->find($id);

        $em->remove($task);
        $em->flush();

        return redirect('/tasks')->with('success_message', 'Task successfully removed');
    }

    public function toggleStatus($id, EntityManagerInterface $em)
    {
        $task = $em->getRepository(Task::class)->find($id);

        $task->toggleStatus();
        $newStatus = ($task->isDone()) ? 'done' : 'not done';

        $em->flush();

        return redirect('/tasks')->with('success_message', 'Task successfully marked as '.$newStatus);
    }
}
