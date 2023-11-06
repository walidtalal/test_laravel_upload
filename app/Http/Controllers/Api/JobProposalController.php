<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Proposal;
use Illuminate\Http\Request;

class JobProposalController extends Controller
{
    /**
     * Display all proposals for each job........      .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $jobs = Job::with('Proposal')->get();

        return response()->json($jobs, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new job proposal
        $data = $request->validate([
            'job_id' => 'required|integer',
            'user_id' => 'required|integer',
            'proposal' => 'required|string',
            'budget' => 'required|integer',
            'status' => 'required|string',
        ]);

        $jobProposal = Proposal::create($data);

        return response()->json($jobProposal, 201);
    }

    /**
     * Display the specified job's proposals.
     */
    public function show(Job $job)
    {
        $jobProposals = $job->Proposal;

        return response()->json($jobProposals, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proposal $jobProposal)
    {
        // Update an existing job proposal
        $data = $request->validate([
            'job_id' => 'integer',
            'user_id' => 'integer',
            'proposal' => 'string',
            'budget' => 'integer',
            'status' => 'string',
        ]);

        $jobProposal->update($data);

        return response()->json($jobProposal, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $jobProposal)
    {
        // Delete a job proposal
        $jobProposal->delete();
        return response()->json(null, 200);
    }
}
