<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VolunteerDashboardController extends Controller
{
    public function show($id)
    {
        $volunteer = Volunteer::findOrFail($id);

        // load polls with options
        $polls = Poll::with('options')->get()->map(function ($poll) {
            return [
                'id' => $poll->id,
                'question' => $poll->question,
                'max_votes' => $poll->max_votes,
                'total_votes' => $poll->options->sum('votes'),
                'options' => $poll->options->map(fn($o) => [
                    'id' => $o->id,
                    'text' => $o->text,
                    'votes' => $o->votes,
                ])->toArray(),
            ];
        })->toArray();

        return view('volunteer-dashboard-new', [
            'volunteer' => $volunteer,
            'polls' => $polls,
        ]);
    }

    public function update(Request $request, $id)
    {
        $volunteer = Volunteer::findOrFail($id);

        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'mobile' => 'required|string|max:20',
                'facebook_name' => 'nullable|string|max:255',
                'birthdate' => 'required|date',
                'address' => 'required|string',
                'education' => 'required|string|max:100',
                'training' => 'nullable|string',
                'skills' => 'nullable|string',
                'classes' => 'nullable|string',
                'availability' => 'required|array|min:1',
                'volunteer_area' => 'required|string|max:255',
                'lifegroup' => 'required|in:yes,no',
                'emergency_name' => 'required|string|max:255',
                'emergency_relation' => 'required|string|max:255',
                'emergency_phone' => 'required|string|max:20',
                'emergency_email' => 'nullable|string|email|max:255',
            ]);

            // Convert availability array to string
            $validated['availability'] = implode(', ', $validated['availability']);

            $volunteer->update($validated);

            return redirect("/volunteer/{$id}/dashboard")
                ->with('success', 'Profile updated successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function delete($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->delete();

        return redirect('/volunteer-form')
            ->with('success', 'Volunteer profile deleted. You can create a new profile.');
    }
}
