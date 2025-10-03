<?php
require "db.php";

extract($_POST);

if (isset($_POST['viewRecords'])) {

    $sql = "SELECT * FROM students";
    $result = mysqli_query($conn, $sql);

    $data = '<table class="table">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>';

    while ($row = $result->fetch_assoc()) {
        $data .= '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" onclick="studentInfo(' . $row['id'] . ')">
                            Update
                        </button> |
                        <button type="button" class="btn btn-danger" data-toggle="modal" onclick="deleteStudent(' . $row['id'] . ')">
                            Delete
                        </button>
                    </td>
                </tr>';
    }

    $data .= '</table>';
    echo $data;
}

if (isset($_POST['studentname']) && isset($_POST['studentemail'])) {
    $sql = "INSERT INTO students(name, email) VALUES('$studentname', '$studentemail')";
    mysqli_query($conn, $sql);
};

if (isset($_POST['id'])) {
    $s_id = $_POST['id'];
    $response = array();

    $sql = "SELECT * FROM students WHERE id = '$s_id'";
    $result = mysqli_query($conn, $sql);

    while($row = $result->fetch_assoc()){
        $response = $row;
    }
    echo json_encode($response);
}


if (isset($_POST['id']) && isset($_POST['Updatestudentname']) && isset($_POST['Updatestudentemail'])) {
    $sql = "UPDATE students SET name = '$Updatestudentname', email = '$Updatestudentemail' WHERE id = '$id'";
    mysqli_query($conn, $sql);
};


if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $sql = "DELETE FROM students WHERE id = '$student_id'";
    mysqli_query($conn, $sql);
}
