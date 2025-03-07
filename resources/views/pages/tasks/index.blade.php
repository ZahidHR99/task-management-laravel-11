@extends('layouts.app')

@section('content')

@section('title')
Task Management
@stop

<!-- content start -->
<div class="container mt-3 mb-3">

    <div class="d-flex flex-row">
        <div class="me-2">
            <!-- task create button -->
            <a href="{{ url('/create-task') }}"><button type="button" class="btn btn-primary mb-2">Add New Task</button></a>
        </div>
        <div class="me-2">
            <div class="dropdown">
                <button
                    class="btn btn-primary dropdown-toggle"
                    type="button"
                    id="priorityDropdown"
                    data-mdb-dropdown-init
                    data-mdb-ripple-init
                    aria-expanded="false"
                >
                    Filter tasks by priority
                </button>
                <ul class="dropdown-menu" aria-labelledby="priorityDropdown">
                    <li><a class="dropdown-item" href="{{ route('tasks.index', ['priority' => 'Low', 'status' => request('status')]) }}">Low</a></li>
                    <li><a class="dropdown-item" href="{{ route('tasks.index', ['priority' => 'Medium', 'status' => request('status')]) }}">Medium</a></li>
                    <li><a class="dropdown-item" href="{{ route('tasks.index', ['priority' => 'High', 'status' => request('status')]) }}">High</a></li>
                </ul>
            </div>
        </div>

        <div class="me-2">
            <div class="dropdown">
                <button
                    class="btn btn-primary dropdown-toggle"
                    type="button"
                    id="statusDropdown"
                    data-mdb-dropdown-init
                    data-mdb-ripple-init
                    aria-expanded="false"
                >
                    Filter tasks by status
                </button>
                <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                    <li><a class="dropdown-item" href="{{ route('tasks.index', ['priority' => request('priority'), 'status' => 0]) }}">Pending</a></li>
                    <li><a class="dropdown-item" href="{{ route('tasks.index', ['priority' => request('priority'), 'status' => 1]) }}">Completed</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- alert component -->
    @include('components.alert')

    <!--start task view table -->
    <div class="table-responsive">
        <table class="table table-striped table_id">
            <thead class="table-dark">
                <tr>
                <th scope="col">SL</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Priority</th>
                <th scope="col">Status</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $index => $task)
                    <tr class="data-row" data-id="{{ $task->id }}">
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $task->title ?? '' }}</td>
                        <td>{{ $task->description ?? '' }}</td>
                        <td>{{ $task->priority ?? '' }}</td>
                        <td>{{ $task->status ? 'Completed' : 'Pending' }}</td>
                        <td>{{ $task->created_at->format('M-d-Y H:i:s') }}</td>
                        <td>
                        <!-- edit task -->
                        <a href="{{ route('task.edit', $task->id) }}"><button type="button" class="btn btn-sm btn-success mb-2">Edit</button></a>
                        <!-- delete task -->
                        <form action="{{ route('task.delete', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  class="btn btn-sm btn-danger mb-2" onclick="confirmDelete({{ $task->id }})">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach

                @if ($tasks->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No tasks available.</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
    <!-- end task view table -->

    <!-- start task pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{-- Previous Button --}}
            <li class="page-item {{ $tasks->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $tasks->previousPageUrl() }}" aria-label="Previous">Previous</a>
            </li>

            {{-- Page Numbers --}}
            @foreach ($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $tasks->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">
                        {{ $page }}
                        @if ($page == $tasks->currentPage())
                            <span class="visually-hidden">(current)</span>
                        @endif
                    </a>
                </li>
            @endforeach

            {{-- Next Button --}}
            <li class="page-item {{ $tasks->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $tasks->nextPageUrl() }}" aria-label="Next">Next</a>
            </li>
        </ul>
    </nav>
    <!-- end task pagination -->
      
    </div>
</div>
<!-- content end -->

<script>
    // confirmation alert for task delete
    function confirmDelete(taskId) {
        // Show a confirmation alert
        if (confirm('Are you sure you want to delete this task?')) {
            // If confirmed, submit the form
            document.getElementById('deleteForm-' + taskId).submit();
        }
    }
</script>

@endsection