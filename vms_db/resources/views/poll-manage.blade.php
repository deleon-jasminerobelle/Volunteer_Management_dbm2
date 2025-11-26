<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Polls</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Manage Polls</h1>
                        <p class="text-gray-600 mt-1">Create and manage volunteer polls</p>
                    </div>
                    <a
                        href="{{ url('/polls/create') }}"
                        class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-medium flex items-center gap-2"
                    >
                        <i class="fas fa-plus"></i>
                        Create Poll
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                @if ($polls->isEmpty())
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500 text-lg">No polls yet</p>
                        <a href="{{ url('/polls/create') }}" class="mt-4 inline-block px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                            Create your first poll
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($polls as $poll)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $poll->question }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <i class="fas fa-chart-bar mr-1"></i>
                                            {{ $poll->options->sum('votes') }} total votes
                                            @if ($poll->max_votes)
                                                | <i class="fas fa-lock mr-1"></i>Max: {{ $poll->max_votes }} votes
                                            @endif
                                        </p>
                                    </div>
                                    <form method="POST" action="{{ url("/polls/{$poll->id}/delete") }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            onclick="return confirm('Are you sure you want to delete this poll?')"
                                            class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        >
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>

                                <div class="space-y-2">
                                    @foreach ($poll->options as $option)
                                        @php
                                            $pct = $poll->options->sum('votes') > 0 ? round(($option->votes / $poll->options->sum('votes')) * 100) : 0;
                                        @endphp
                                        <div>
                                            <div class="flex justify-between text-sm mb-1">
                                                <span class="font-medium">{{ $option->text }}</span>
                                                <span class="text-gray-600">{{ $option->votes }} votes ({{ $pct }}%)</span>
                                            </div>
                                            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-orange-500 transition-all" style="width: {{ $pct }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ url('/') }}" class="text-orange-600 hover:text-orange-700 font-medium">
                        ← Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
