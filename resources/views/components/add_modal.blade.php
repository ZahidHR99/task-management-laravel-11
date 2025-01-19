
<!-- Modal -->
<div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="addTaskLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <form action="{{ route('task.store') }}" method="post">
    @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addTaskLabel">Create New Task</h5>
            <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-2" data-mdb-input-init>
                <label class="form-label" for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required/>
            </div>

            <div class="mb-2" data-mdb-input-init>
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
         
            <div class="mb-2">
                <label class="form-label" for="priority">Priority</label>
                <select class="form-control" id="priority" name="priority" data-mdb-select-init>
                    <option value="Medium">Select Priority</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label" for="status">Status</label>
                <select class="form-control" id="status" name="status" data-mdb-select-init>
                    <option value="0">Select Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Completed</option>
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" data-mdb-ripple-init>Save</button>
        </div>
        </div>
    </form>
  </div>
</div>
