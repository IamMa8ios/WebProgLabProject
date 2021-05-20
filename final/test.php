<html lang="en">
<head>
 <title>Test</title>
</head>

<body>

<div id="alert-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="alert-modal-title" class="modal-title"></h4>
            </div>
            <div id="alert-modal-body" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    function alertModal(title, body) {
        // Display error message to the user in a modal
        $('#alert-modal-title').html(title);
        $('#alert-modal-body').html(body);
        $('#alert-modal').modal('show');
    }

</script>
</body>
</html>