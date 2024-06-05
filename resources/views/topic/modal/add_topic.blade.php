<!-- Modal -->
<div class="modal fade" id="modalAddTopic" role="dialog" aria-labelledby="modalAddTopic" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title">Add Topic</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="frm-add-topic">
                @csrf
                <div class="form-group">
                    <label for="">Topic Name : </label>
                    <input type="hidden" name="id" class="form-control" id="topic_id">
                    <input type="text" name="topic_name" class="form-control" id="topic_name" placeholder="Enter topic name">
                    <span id="err_topic_name"> </span>
                </div>
                <div class="form-group">
                     <label for="">Event Date : </label>
                     <input type="text" name="event_date" id="event_date" class="form-control"  placeholder="Enter event date"> 
                     <span id="err_event_date"> </span>
                </div>
                <div class="form-group">
                    <label for="">Location : </label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="Enter location">
                    <span id="err_location"> </span>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <i class="fas fa-window-close"></i> Close</button>
          <button type="submit" class="btn btn-primary btn-sm" id="btn-save"> <i class="fas fa-save"></i> Save</button>
        </div>
            </form>
      </div>
    </div>
  </div>