<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List:</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="float-center">AJAX BASED CRUD</h1>
        <button type="button" class="btn btn-primary mb-5 float-right" data-toggle="modal" data-target="#exampleModalCenter">
            Add Students
        </button>
    </div>
    <div class="container mt-5" id="view_records">
    </div>

    <!-- ADD Student Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" name="" id="studentName" class="form-control" placeholder="Student Name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="" id="studentEmail" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addStudent()">Add Student</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" id="UpdatestudentName" class="form-control" placeholder="Student Name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" id="UpdatestudentEmail" class="form-control" placeholder="Email">
                        </div>
                        <input type="hidden" id="student_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateStudent()">Update Students</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            viewRecords();
        });

        function viewRecords() {
            var viewRecords = "viewRecords";

            $.ajax({
                url: "process.php",
                type: "post",
                data: {
                    viewRecords: viewRecords,
                },
                success: function(data, status) {
                    $("#view_records").html(data);
                }
            });
        }

        function addStudent() {
            var studentname = $('#studentName').val();
            var studentemail = $('#studentEmail').val();

            $.ajax({
                url: "process.php",
                type: "post",
                data: {
                    studentname: studentname,
                    studentemail: studentemail
                },

                success: function(data, status) {
                    viewRecords();
                }
            });
        }

        function studentInfo(id) {
            $('#student_id').val(id);

            $.ajax({
                url: "process.php",
                type: "post",
                data: {
                    id: id
                },
                success: function(data, status) {
                    var student = JSON.parse(data);
                    $("#UpdatestudentName").val(student.name);
                    $("#UpdatestudentEmail").val(student.email);
                }
            });

            $("#editModal").modal("show");
        }

        function updateStudent() {
            var id = $('#student_id').val();
            var Updatestudentname = $('#UpdatestudentName').val();
            var Updatestudentemail = $('#UpdatestudentEmail').val();

            $.ajax({
                url: "process.php",
                type: "post",
                data: {
                    id: id,
                    Updatestudentname: Updatestudentname,
                    Updatestudentemail: Updatestudentemail
                },

                success: function(data, status) {
                    viewRecords();
                }
            });
        }

        function deleteStudent(student_id) {

            $.ajax({
                url: "process.php",
                type: "post",
                data: {
                    student_id: student_id,
                },

                success: function(data, status) {
                    viewRecords();
                }
            });

        }
    </script>
</body>

</html>