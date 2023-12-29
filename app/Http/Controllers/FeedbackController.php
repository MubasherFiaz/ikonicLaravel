<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\feedback;
use App\Models\User;
use Validator;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Feedback::with(['comments' => function ($query) {
            $query->with('user')->orderBy('id', 'desc');
        }])->orderBy('id', 'desc');

        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('item', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('category', 'like', '%' . $searchTerm . '%');
        }

        $feedbackWithComments = $query->paginate(10);

        return response()->json($feedbackWithComments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'item' => 'required',
                'description' => 'required',
                'category' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => $validator->errors()], 401);
            }
            $input = $request->all();
            $input['votes']=0;
            $user = feedback::create($input);
            return response()->json(['status' => '200'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => '402'], 200);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(feedback $feedback)
    {
        //
    }
}
