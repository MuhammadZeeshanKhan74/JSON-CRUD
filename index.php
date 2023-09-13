<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta title="Json Crud" content="Json OBJ Crud Operation">
    <meta name="Author" content="❤Muhammad Zeeshan Khan">
    <meta name="contect" content="muhammadzeeshankhan003@gmail.com">
    <title>JSON Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="img/favicon.png">
</head>

<body>
    <div class="container mt-5">
        <div id="msg" class="alert  alert-dismissible fade show" role="alert">


        </div>
        <!-- Button trigger modal -->
        <button type="button" id="AddBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addform">
                            <input type="hidden" id="ActionValue" name="action" value="add">
                            <input type="hidden" id="Edit_ID" name="edit_id">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="EditName" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="fatherName" class="form-label">Father Name</label>
                                <input type="text" id="EditFathername" class="form-control" name="fatherName">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="EditPhone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="EditEmail" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="EditPassword" name="password" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submitBtn" class="btn btn-primary close-btn">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">FatherName</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="userList">

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#AddBtn', function() {
                $('#exampleModalLabel').html('Insert Form');
                $('#ActionValue').val('add');
                $('#EditName').val('');
                $('#EditFathername').val('');
                $('#EditPhone').val('');
                $('#EditEmail').val('');
                $('#EditPassword').val('');
                $('#submitBtn').html('Add');
                $('#Edit_ID').val('');

            });
            // Fetch Data From Database
            function GetList() {
                $.ajax({
                    url: 'backend.php',
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        'action': "GET"
                    },
                    success: function(response) {
                        // console.log(response);
                        var tbody = $('#userList');
                        var html;
                        var i = 1;
                        if (response != '') {
                            alert('heelo')
                            $.each(response, function(index, value) {
                                var JSonResult = JSON.parse(value.details);
                                html += '<tr>';
                                html += '<td>' + i + '</td>';
                                html += '<td>' + JSonResult.name + '</td>';
                                html += '<td>' + JSonResult.fatherName + '</td>';
                                html += '<td>' + JSonResult.phone + '</td>';
                                html += '<td>' + JSonResult.email + '</td>';
                                html += '<td>' + JSonResult.password + '</td>';
                                html += '<td><a id="editBtn" class="btn btn-success" value="' + value.id + '" data-bs-target="#exampleModal" data-bs-toggle="modal"><i class="fa-regular fa-pen-to-square"></i></a> <a id="deleteBtn" class="btn btn-danger" value="' + value.id + '" ><i class="fa-solid fa-trash"></i></a></td>';
                                html += '</tr>';
                                i++;
                            });
                        } else {
                            html += '<tr>';
                            html += '<td colspan="7" class="text-center text-danger p-5" style="font-weight:bold;">No Record Found</td>';
                            html += '</td>';

                        }

                        tbody.html(html);
                    }
                });
            }
            GetList();

            // Form on Submit
            $('#addform').on('submit', function(e) {
                e.preventDefault();
                // If Submitted Add Form 
                if ($('#submitBtn').text() == 'Add') {
                    $('#ActionValue').val('add');
                    $.ajax({
                        url: "backend.php",
                        type: "POST",
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        data: new FormData(this),
                        success: function(response) {
                            if (response.msgStatus == 'success') {
                                $('#msg').addClass('alert-success');
                                $('#msg').html(response.msg);
                                $("#msg").show();
                                $('#exampleModal').modal('hide');
                                alertAutoClose();
                            } else if (response.msgStatus == 'fail') {
                                $('#msg').addClass('alert-danger');
                                $('#msg').html(response.msg);
                                $("#msg").show();
                                $('#exampleModal').modal('hide');
                                alertAutoClose();
                            }
                            $('#addform')[0].reset();
                            GetList();

                        }
                    });
                } else if ($('#submitBtn').text() == 'Update') { // If Submitted Update Form 
                    $('#ActionValue').val('update');
                    $.ajax({
                        url: "backend.php",
                        type: "POST",
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        data: new FormData(this),
                        success: function(response) {
                            if (response.msgStatus == 'success') {
                                $('#msg').addClass('alert-success');
                                $('#msg').html(response.msg);
                                $('#exampleModal').modal('hide');
                                $("#msg").show();
                                $('#addform')[0].reset();
                                alertAutoClose();
                                GetList();
                            } else if (response.msgStatus == 'fail') {
                                $('#msg').addClass('alert-danger');
                                $('#msg').html(response.msg);
                                $("#msg").show();
                                $('#exampleModal').modal('hide');
                                alertAutoClose();
                            }
                        }
                    });
                }

            })

            // Fetch Particular User Data from database
            $(document).on('click', '#editBtn', function() {

                $('#exampleModalLabel').html('Edit');
                $('#submitBtn').html('Update');

                $.ajax({
                    url: 'backend.php',
                    type: "POST",
                    data: {
                        id: $(this).attr('value'),
                        action: 'edit'
                    },
                    success: function(response) {
                        console.log(response)
                        if (response != "") {
                            var data = JSON.parse(response);
                            var details = JSON.parse(data.details);
                            $('#EditName').val(details.name);
                            $('#EditFathername').val(details.fatherName);
                            $('#EditPhone').val(details.phone);
                            $('#EditEmail').val(details.email);
                            $('#EditPassword').val(details.password);
                            $('#Edit_ID').val(data.id);
                        }

                    }

                });

            })
            // For Delete User Data
            $(document).on('click', '#deleteBtn', function() {
                $.ajax({
                    url: 'backend.php',
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        id: $(this).attr('value'),
                        action: "delete"
                    },
                    success: function(response) {
                        if (response.msgStatus == 'success') {
                            $('#msg').addClass('alert-success');
                            $('#msg').html(response.msg);
                            $('#exampleModal').modal('hide');
                            $("#msg").show();
                            $('#addform')[0].reset();
                            alertAutoClose();
                            GetList();
                        } else if (response.msgStatus == 'fail') {
                            $('#msg').addClass('alert-danger');
                            $('#msg').html(response.msg);
                            $("#msg").show();
                            $('#exampleModal').modal('hide');
                            alertAutoClose();
                        }
                    }
                });

            });

            // For close alert automatically
            function alertAutoClose() {
                setTimeout(() => {
                    $("#msg").hide();
                }, 2000);
            }

        });
    </script>
</body>

</html>