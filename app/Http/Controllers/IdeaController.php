<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateIdea;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\IdeaStatus;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $ideas = Auth::user()
            ->ideas()
            ->when(in_array($request->status, IdeaStatus::values()), fn ($query) => $query->where('status', $request->status)) // add where clause if status is present in the request
            ->latest()
            ->get();

        return view('idea.index', [
            'ideas' => $ideas,
            'statusCounts' => Idea::statusCounts(Auth::user()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request, CreateIdea $createIdea): \Illuminate\Http\RedirectResponse
    {

        $createIdea->handle($request->safe()->all());

        return to_route('idea.index')->with('success', 'Idea created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('idea.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea): \Illuminate\Http\RedirectResponse
    {

        $idea->delete();

        return redirect()->route('idea.index');
    }
}
