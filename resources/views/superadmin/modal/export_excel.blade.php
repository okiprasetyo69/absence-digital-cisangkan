<!-- Modal -->
<div class="modal fade" id="modalExportExcel" role="dialog" aria-labelledby="modalExportExcel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title-export"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <table class="table table-border table-striped text-center" id="table-export-excel">
                    <thead> 
                        <tr class=""> 
                            <th colspan="4"> Report List Absence </th>
                        </tr>
                    </thead>
                    <thead> 
                        <tr> 
                            <th> Event Date : </th> 
                            <th id="event_date_report"> - </th>
                        </tr>
                    </thead>
                    <thead> 
                        <tr> 
                            <th> Topic Name : </th> 
                            <th id="topic_name_report"> - </th>
                        </tr>
                    </thead>
                    <thead>
                        <tr class="">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Signature</th>
                        </tr>
                    </thead>
                    
                    <tbody class="rowData">
                        <!-- passing data na teh kumaha uy poho deui wkwk -->
          
                    </tbody>
                  
              </table>
              <iframe id="txtArea1" style="display:none"></iframe>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                <i class="fas fa-window-close"></i> Close
            </button>
            <button type="button" class="btn btn-info btn-sm" id="btn-export">
                <i class="fa fa-download"></i> Download
            </button>
        </div>
      </div>
    </div>
  </div>