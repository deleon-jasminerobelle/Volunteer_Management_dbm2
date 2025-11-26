<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Poll</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create New Poll</h1>
                <p class="text-gray-600 mb-8">Add a poll for volunteers to vote on</p>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <h3 class="text-red-800 font-semibold mb-2">Errors</h3>
                        <ul class="list-disc list-inside text-red-700 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/polls/create') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                            Poll Question <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            id="question"
                            name="question"
                            value="{{ old('question') }}"
                            placeholder="e.g., What time works best for volunteer meetings?"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none"
                            required
                        />
                    </div>

                    <div>
                        <label for="max_votes" class="block text-sm font-medium text-gray-700 mb-2">
                            Maximum Votes (Optional)
                        </label>
                        <input
                            type="number"
                            id="max_votes"
                            name="max_votes"
                            value="{{ old('max_votes') }}"
                            placeholder="Leave empty for unlimited votes"
                            min="1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none"
                        />
                        <p class="text-xs text-gray-500 mt-1">Set a limit to close voting after a certain number of votes</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Poll Options <span class="text-red-600">*</span>
                        </label>
                        <div id="options-container" class="space-y-3">
                            <div class="flex gap-2">
                                <input
                                    type="text"
                                    name="options[]"
                                    value="{{ old('options.0') ?? '' }}"
                                    placeholder="Option 1"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none"
                                    required
                                />
                            </div>
                            <div class="flex gap-2">
                                <input
                                    type="text"
                                    name="options[]"
                                    value="{{ old('options.1') ?? '' }}"
                                    placeholder="Option 2"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none"
                                    required
                                />
                            </div>
                        </div>
                        <button
                            type="button"
                            onclick="addOption()"
                            class="mt-3 px-4 py-2 text-orange-600 border border-orange-600 rounded-lg hover:bg-orange-50 transition-colors font-medium"
                        >
                            + Add Option
                        </button>
                    </div>

                    <div class="flex gap-3 pt-6">
                        <button
                            type="submit"
                            class="flex-1 px-4 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-medium"
                        >
                            Create Poll
                        </button>
                        <a
                            href="{{ url('/polls/manage') }}"
                            class="px-4 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors font-medium text-center"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addOption() {
            const container = document.getElementById('options-container');
            const count = container.children.length;
            const div = document.createElement('div');
            div.className = 'flex gap-2';
            div.innerHTML = `
                <input
                    type="text"
                    name="options[]"
                    placeholder="Option ${count + 1}"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none"
                    required
                />
                <button
                    type="button"
                    onclick="this.parentElement.remove()"
                    class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg"
                >Remove</button>
            `;
            container.appendChild(div);
        }
    </script>
</body>
</html>
