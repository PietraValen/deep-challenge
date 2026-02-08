<?php

namespace App\Http\Controllers;

use App\DTOs\ProcessDTO;
use App\Models\Process;
use App\Services\ClientService;
use App\Services\ProcessService;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function __construct(
        protected ProcessService $service,
        protected ClientService $clientService
    ) {
    }

    public function index(Request $request)
    {
        $processes = $this->service->getUserProcesses($request->user());
        return view('processes.index', compact('processes'));
    }

    public function create(Request $request)
    {
        $clients = $this->clientService->getUserClients($request->user());
        return view('processes.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        // Ensure client belongs to user
        $client = \App\Models\Client::find($request->client_id);
        if ($client->user_id !== $request->user()->id) {
            abort(403);
        }

        $dto = ProcessDTO::fromRequest($request->all());
        $this->service->createProcess($request->user(), $dto);

        return redirect()->route('processes.index')->with('success', 'Process created successfully.');
    }

    public function edit(Process $process)
    {
        $this->authorize('update', $process);
        $clients = $this->clientService->getUserClients(request()->user());
        return view('processes.edit', compact('process', 'clients'));
    }

    public function update(Request $request, Process $process)
    {
        $this->authorize('update', $process);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $client = \App\Models\Client::find($request->client_id);
        if ($client->user_id !== $request->user()->id) {
            abort(403);
        }

        $dto = ProcessDTO::fromRequest($request->all());
        $this->service->updateProcess($process, $dto);

        return redirect()->route('processes.index')->with('success', 'Process updated successfully.');
    }

    public function destroy(Process $process)
    {
        $this->authorize('delete', $process);
        $this->service->deleteProcess($process);
        return redirect()->route('processes.index')->with('success', 'Process deleted successfully.');
    }
}
