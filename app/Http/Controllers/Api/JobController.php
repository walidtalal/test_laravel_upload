<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index() {
        // Retrieve and return a list of jobs
        $jobs = Job::all();
        return response()->json($jobs, 200);
    }

    public function show($id) {
        // Retrieve and return a specific job by ID
        $job = Job::findOrFail($id);
        return response()->json($job, 200);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|string',
            'user_id' => 'required|integer',
            'location_id' => 'required|integer',
            'skill_id' => 'required|integer',

        ]);

        $jobData = $request->except('id');
        $job = Job::create($jobData);

        return response()->json($job, 201);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|string',
            'user_id' => 'required|integer',
            'location_id' => 'required|integer',
            'skill_id' => 'required|integer',

        ]);

        $job = Job::findOrFail($id);
        $jobData = $request->except('id');
        $job->update($jobData);

        return response()->json($job, 200);
    }


    public function destroy($id) {
        // Delete a specific job by ID
        $job = Job::findOrFail($id);
        $job->delete();

        return response()->json(['message' => 'Job deleted'], 200);
    }
}
