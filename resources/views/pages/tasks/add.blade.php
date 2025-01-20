@extends('layouts.app')

@section('content')

@section('title')
    {{ isset($task) ? 'Edit Task' : 'Create New Task' }}
@stop

<!-- content start -->
<div class="container mt-3 mb-3">

    <!-- alert component -->
    @include('components.alert')

    <!-- start task add or update form -->
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($task) ? route('update.task', $task->id) : route('task.store') }}" method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskLabel">
                        {{ isset($task) ? 'Edit Task' : 'Create New Task' }}
                    </h5>
                </div>

                <div class="modal-body">
                    <div class="mb-2" data-mdb-input-init>
                        <label class="form-label" for="title">Title</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $task->title ?? '') }}"
                        />
                    </div>

                    <div class="mb-2" data-mdb-input-init>
                        <label class="form-label" for="description">Description</label>
                        <textarea
                            class="form-control"
                            id="description"
                            name="description"
                            rows="3"
                        >{{ old('description', $task->description ?? '') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <label class="form-label" for="priority">Priority</label>
                                <select
                                    class="form-control"
                                    id="priority"
                                    name="priority"
                                    data-mdb-select-init
                                >
                                    <option value="Medium">Select Priority</option>
                                    <option value="Low" {{ (old('priority', $task->priority ?? '') == 'Low') ? 'selected' : '' }}>Low</option>
                                    <option value="Medium" {{ (old('priority', $task->priority ?? '') == 'Medium') ? 'selected' : '' }}>Medium</option>
                                    <option value="High" {{ (old('priority', $task->priority ?? '') == 'High') ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <label class="form-label" for="status">Status</label>
                                <select
                                    class="form-control"
                                    id="status"
                                    name="status"
                                    data-mdb-select-init
                                >
                                    <option value="0">Select Status</option>
                                    <option value="0" {{ (old('status', $task->status ?? '') == '0') ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ (old('status', $task->status ?? '') == '1') ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('/dashboard') }}">
                        <button type="button" class="btn btn-secondary">Back</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- end task add or update form -->

</div>

@endsection