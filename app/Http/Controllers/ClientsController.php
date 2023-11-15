<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clients\ClientCreateRequest;
use App\Http\Requests\Clients\ClientUpdateRequest;
use App\Models\Clients;
use App\Models\Scope;
use Illuminate\View\View;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $clients = Clients::all();
        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('clients.create', [
            'scopes' => Scope::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientCreateRequest $request): RedirectResponse
    {
        //
        $validatedRequest = $request->validated();
        $scopes = Scope::findMany($validatedRequest['scopes']);
        $clientRepository = new ClientRepository();
        switch ($validatedRequest['client_type']) {
            case 'personal_access_client':
                $client = $clientRepository->createPersonalAccessClient(null, $validatedRequest['name'], $validatedRequest['redirect']);
                break;
            case 'password_client':
                $client = $clientRepository->createPasswordGrantClient(null, $validatedRequest['name'], $validatedRequest['redirect'], 'users');
                break;
            case 'client_credentials':
                $client = $clientRepository->create(null, $validatedRequest['name'], '');
                break;
            default:
                return Redirect::back()->withErrors(["client_type"=>"client_type not valid"]);
        }
        $client = Clients::find($client->id);
        $client->scopes()->sync(array_column($scopes->toArray(), 'id'));
        return Redirect::route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //
        $client = Clients::find($id);
        $client['scopes'] = array_column($client->scopes()->get()->toArray(), 'id');
        return view('clients.edit', [
                'client' => $client,
                'scopes' => Scope::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientUpdateRequest $request, string $id) : RedirectResponse
    {
        //
        $client = Clients::find($id);
        $validatedRequest = $request->validated();
        $scopes = Scope::findMany($validatedRequest['scopes']);
        $client->update([
            "name" => $validatedRequest['name'],
            "redirect" => is_null($validatedRequest['redirect']) ? '': $validatedRequest['redirect']
        ]);
        $client->scopes()->sync(array_column($scopes->toArray(), 'id'));

        return Redirect::route('clients.edit', $client)
            ->with('status', 'client-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Revoke the specified resource from storage.
     */
    public function revoke(string $id): RedirectResponse
    {
        //
        $clientRepository = new ClientRepository();
        $client = $clientRepository->revoked($id);
        return Redirect::route('clients.show', $client);
    }
}
