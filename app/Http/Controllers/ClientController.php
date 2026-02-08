<?php

namespace App\Http\Controllers;

use App\DTOs\ClientDTO;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(protected ClientService $service)
    {
    }

    public function index(Request $request)
    {
        $clients = $this->service->getUserClients($request->user());
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'document' => 'nullable|string|max:20',
        ]);

        $dto = ClientDTO::fromRequest($request->all());
        $this->service->createClient($request->user(), $dto);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        $this->authorize('update', $client);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'document' => 'nullable|string|max:20',
        ]);

        $dto = ClientDTO::fromRequest($request->all());
        $this->service->updateClient($client, $dto);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        $this->service->deleteClient($client);
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
