<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Poll;
use Illuminate\Http\Request;

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

        return view('volunteer-dashboard', [
            'volunteer' => $volunteer,
            'polls' => $polls,
            'csrf' => csrf_token(),
        ]);
    }
}
