<?php
require_once "scripts.php";
require_once "data-loader.php";
sessionCheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "navigation-head.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body class="nav-md yo">

<div class="container body">
    <div class="main_container">


        <?php include("navigation-sidebar.php"); ?>
        <?php include("navigation-top-user.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-6">
                    <div class="card" >

                        <form name="add_name" id="add_name" method="post" action="upload-poll-options.php">
                            <div class="card-title" id="yo">
                                <input type="text" name="Title" placeholder="Enter Poll Title" class="form-control name_list" required/>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <input type="text" name="options[]" placeholder="Option Value"
                                           class="form-control name_list " required/> <br>
                                    <input type="text" name="options[]" placeholder="Option Value"
                                           class="form-control name_list" required/> <br>

                                    <table id="dynamic_field">

                                    </table>
                                </div>

                            </div>
                            <div class="card-footer" id="yo">
                                <button type="button" name="add" id="add" class="addButton">Add <span class="fa fa-plus-square"></button>
                                <button type="submit" name="submit" id="submit" class="myButton1">Publish</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include_once "navigation-footer.php"; ?>
        <!-- /footer content -->
    </div>
</div>

<script>
    $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'">' +
                '<td><input type="text" name="options[]" placeholder="Option Value" class="form-control name_list" required/></td>' +
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

        // $('#submit').click(function(){
        //     $.ajax({
        //         url:"upload-poll-options.php",
        //         method:"POST",
        //         data:$('#add_name').serialize()
        //     });
        // });

    });
</script>

<script> // dynamically add inputs for creating polls
    let id = '1' // init the <option> id
    let nameID = '3'

    function addOption() {
        const newOption = document.createElement('input') // create an <input>

        newOption.id = id // assign an id to it
        id = parseInt(id) + 1 // increase the id by 1

        newOption.setAttribute('type', 'text')
        newOption.setAttribute('placeholder', 'Option Value')
        newOption.setAttribute('style', 'max-width: 100%')
        newOption.setAttribute('style', 'margin: 2px 0px')
        newOption.setAttribute('name', 'option' + (nameID++))

        document.getElementById('optionsDiv').appendChild(newOption) // add <input> to its <div>
    }
</script>

<script> // removes the dynamically added inputs
    function resetOptions {
        // const myDiv = document.getElementById('anInputDiv') // div to remove
        // const parent = myDiv.parentNode // div's parent
        // parent.removeChild(myDiv)

    }
</script>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
