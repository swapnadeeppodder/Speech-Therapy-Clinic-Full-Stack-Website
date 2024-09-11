<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "speech_therapy_clinic_therapist");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collecting form data
$fullname = $_POST['fullname'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$license = $_POST['license'];
$education = $_POST['education'];
$experience = $_POST['experience'];
$specialization = $_POST['specialization'];
$certificate = $_FILES['certificate']['name'];
$photo = $_FILES['photo']['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$otp = $_POST['otp'];

// Check if passwords match
if ($password != $confirm_password) {
    die("Passwords do not match.");
}

// Check OTP functionality - this is placeholder code
if ($otp != "123456") { // Replace with actual OTP validation
    die("Invalid OTP.");
}

// Move uploaded file
move_uploaded_file($_FILES['certificate']['tmp_name'], "uploads/" . $certificate);

// Insert data into database
$sql = "INSERT INTO therapists (fullname, dob, gender, contact, license, education, experience, specialization, certificate, email, password) VALUES ('$fullname', '$dob', '$gender', '$contact', '$license', '$education', '$experience', '$specialization', '$certificate', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. <a href='login.html'>Login here</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>  