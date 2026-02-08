<?php

namespace App\Http\Controllers;

use App\DTOs\DeadlineDTO;
use App\Models\Deadline;
use App\Services\DeadlineService;
use App\Services\ProcessService;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    public function __construct(
        protected DeadlineService $service,
        protected ProcessService $processService
    ) {
    }

    public function index(Request $request)
    {
        $deadlines = $this->service->getUserDeadlines($request->user());
        return view('deadlines.index', compact('deadlines'));
    }

    public function create(Request $request)
    {
        $processes = $this->processService->getUserProcesses($request->user());
        return view('deadlines.create', compact('processes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'process_id' => 'nullable|exists:processes,id',
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        if ($request->process_id) {
            $process = \App\Models\Process::find($request->process_id);
            if ($process->user_id !== $request->user()->id) {
                abort(403);
            }
        }

        $dto = DeadlineDTO::fromRequest($request->all());
        $this->service->createDeadline($request->user(), $dto);

        return redirect()->route('deadlines.index')->with('success', 'Deadline created successfully.');
    }

    public function edit(Deadline $deadline)
    {
        $this->authorize('update', $deadline);
        $processes = $this->processService->getUserProcesses(request()->user());
        return view('deadlines.edit', compact('deadline', 'processes'));
    }

    public function update(Request $request, Deadline $deadline)
    {
        $this->authorize('update', $deadline);

        $request->validate([
            'process_id' => 'nullable|exists:processes,id',
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        if ($request->process_id) {
            $process = \App\Models\Process::find($request->process_id);
            if ($process->user_id !== $request->user()->id) {
                abort(403);
            }
        }

        $dto = DeadlineDTO::fromRequest($request->all());
        $this->service->updateDeadline($deadline, $dto);

        return redirect()->route('deadlines.index')->with('success', 'Deadline updated successfully.');
    }

    public function destroy(Deadline $deadline)
    {
        $this->authorize('delete', $deadline);
        $this->service->deleteDeadline($deadline);
        return redirect()->route('deadlines.index')->with('success', 'Deadline deleted successfully.');
    }
}
