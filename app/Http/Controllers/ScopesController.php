<?php

namespace App\Http\Controllers;

use App\Http\Requests\Scopes\ScopeCreateRequest;
use App\Http\Requests\Scopes\ScopeUpdateRequest;
use App\Models\Scope;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ScopesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $scopes = Scope::all();
        return view('scopes.index', [
           'scopes' => $scopes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('scopes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScopeCreateRequest $request): RedirectResponse
    {
        //
        $validatedRequest = $request->validated();
        $scope = new Scope();
        $scope->fill($validatedRequest)->save();
        return Redirect::route('scopes.index');
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
    public function edit(Scope $scope): View
    {
        //
        return view('scopes.edit', [
            'scope' => $scope
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScopeUpdateRequest $request, Scope $scope): RedirectResponse
    {
        //
        $validatedRequest = $request->validated();
        $scope->update($validatedRequest);
        return Redirect::route('scopes.edit', $scope)
            ->with('status', 'scope-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scope $scope): RedirectResponse
    {
        //
        $scope->delete();
        return Redirect::route('scopes.index')
            ->with('status', 'scope-deleted');
    }
}
