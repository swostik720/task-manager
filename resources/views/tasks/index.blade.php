@extends('layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container">
    <h1>Your Tasks</h1>

    <div class="mb-3">
        <form method="GET" action="{{ route('tasks.index') }}">
            <label for="category" class="form-label">Filter by Category</label>
            <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach ($tasks->pluck('category')->unique() as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="mb-3">
        <h5>Task Completion Progress</h5>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $completionPercentage }}%" aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0" aria-valuemax="100">{{ $completionPercentage }}%</div>
        </div>
    </div>

    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $task->title }}</strong> - {{ $task->category }}
                    @if ($task->is_complete)
                        <span class="badge bg-success">Complete</span>
                    @else
                        <span class="badge bg-warning">Incomplete</span>
                    @endif
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-primary toggle-completion" data-task-id="{{ $task->id }}">
                        {{ $task->is_complete ? 'Mark Incomplete' : 'Mark Complete' }}
                    </button>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.toggle-completion').forEach(button => {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-task-id');
                const button = this;

                fetch(`/tasks/${taskId}/toggle-completion`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const isComplete = data.is_complete;
                        button.textContent = isComplete ? 'Mark Incomplete' : 'Mark Complete';
                        const badge = button.closest('.list-group-item').querySelector('.badge');
                        badge.textContent = isComplete ? 'Complete' : 'Incomplete';
                        badge.className = isComplete ? 'badge bg-success' : 'badge bg-warning';
                    }
                })
                // .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endsection
