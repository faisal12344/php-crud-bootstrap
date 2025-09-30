<?php
require_once 'class/DBController.php';
require_once 'class/Student.php';
require_once 'class/Attendance.php';

$db_handle = new DBController();

// default-safe action
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {

    case 'attendance-add':
        if (isset($_POST['add'])) {
            $attendance = new Attendance();

            // attendance date (default: today if empty)
            $attendance_date = !empty($_POST['attendance_date'])
                ? date('Y-m-d', strtotime($_POST['attendance_date']))
                : date('Y-m-d');

            // reset the day then add rows
            $attendance->deleteAttendanceByDate($attendance_date);

            if (!empty($_POST['student_id']) && is_array($_POST['student_id'])) {
                foreach ($_POST['student_id'] as $student_id) {
                    $present = 0;
                    $absent  = 0;
                    $key = "attendance-$student_id";
                    if (isset($_POST[$key])) {
                        if ($_POST[$key] === 'present') $present = 1;
                        elseif ($_POST[$key] === 'absent') $absent = 1;
                    }
                    $attendance->addAttendance($attendance_date, $student_id, $present, $absent);
                }
            }

            header('Location: index.php?action=attendance');
            exit;
        }

        $student = new Student();
        $studentResult = $student->getAllStudent();
        require_once 'web/attendance-add.php';
        break;

    case 'attendance-edit':
        $attendance_date = isset($_GET['date']) ? $_GET['date'] : '';
        if ($attendance_date === '') {
            header('Location: index.php?action=attendance');
            exit;
        }

        $attendance = new Attendance();

        if (isset($_POST['add'])) {
            $attendance->deleteAttendanceByDate($attendance_date);

            if (!empty($_POST['student_id']) && is_array($_POST['student_id'])) {
                foreach ($_POST['student_id'] as $student_id) {
                    $present = 0;
                    $absent  = 0;
                    $key = "attendance-$student_id";
                    if (isset($_POST[$key])) {
                        if ($_POST[$key] === 'present') $present = 1;
                        elseif ($_POST[$key] === 'absent') $absent = 1;
                    }
                    $attendance->addAttendance($attendance_date, $student_id, $present, $absent);
                }
            }

            header('Location: index.php?action=attendance');
            exit;
        }

        $result = $attendance->getAttendanceByDate($attendance_date);

        $student = new Student();
        $studentResult = $student->getAllStudent();
        require_once 'web/attendance-edit.php';
        break;

    case 'attendance-delete':
        $attendance_date = isset($_GET['date']) ? $_GET['date'] : '';
        if ($attendance_date !== '') {
            $attendance = new Attendance();
            $attendance->deleteAttendanceByDate($attendance_date);
        }
        $attendance = new Attendance();
        $result = $attendance->getAttendance();
        require_once 'web/attendance.php';
        break;

    case 'attendance':
        $attendance = new Attendance();
        $result = $attendance->getAttendance();
        require_once 'web/attendance.php';
        break;

    case 'student-add':
        if (isset($_POST['add'])) {
            $name        = isset($_POST['name']) ? $_POST['name'] : '';
            $roll_number = isset($_POST['roll_number']) ? $_POST['roll_number'] : '';
            $dob         = !empty($_POST['dob']) ? date('Y-m-d', strtotime($_POST['dob'])) : '';
            $class       = isset($_POST['class']) ? $_POST['class'] : '';

            $student  = new Student();
            $insertId = $student->addStudent($name, $roll_number, $dob, $class);

            if (empty($insertId)) {
                $response = array('message' => 'Problem in Adding New Record', 'type' => 'error');
            } else {
                header('Location: index.php');
                exit;
            }
        }
        require_once 'web/student-add.php';
        break;

    case 'student-edit':
        $student_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($student_id <= 0) {
            header('Location: index.php');
            exit;
        }

        $student = new Student();

        if (isset($_POST['add'])) {
            $name        = isset($_POST['name']) ? $_POST['name'] : '';
            $roll_number = isset($_POST['roll_number']) ? $_POST['roll_number'] : '';
            $dob         = !empty($_POST['dob']) ? date('Y-m-d', strtotime($_POST['dob'])) : '';
            $class       = isset($_POST['class']) ? $_POST['class'] : '';

            $student->editStudent($name, $roll_number, $dob, $class, $student_id);

            header('Location: index.php');
            exit;
        }

        $result = $student->getStudentById($student_id);
        require_once 'web/student-edit.php';
        break;

    case 'student-delete':
        $student_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($student_id > 0) {
            $student = new Student();
            $student->deleteStudent($student_id);
        }
        $student = new Student();
        $result = $student->getAllStudent();
        require_once 'web/student.php';
        break;

    default:
        $student = new Student();
        $result = $student->getAllStudent();
        require_once 'web/student.php';
        break;
}
