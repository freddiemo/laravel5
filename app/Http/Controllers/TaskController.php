<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;


class TaskController extends Controller
{

    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param TaskRepository $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Create a new task.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        return view('taks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }
}
