<?php
// Include the database connection file
include('dbconn.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get and sanitize POST inputs
$formType = htmlspecialchars($_POST['formType'] ?? '');
$docName = htmlspecialchars($_POST['docType'] ?? '');
$senderOrRecipient = htmlspecialchars($_POST['senderOrRecipient'] ?? '');
$sendOrReceiveDate = htmlspecialchars($_POST['sendOrReceiveDate'] ?? '');
$description = htmlspecialchars($_POST['description'] ?? '');

// Validate required fields
if (empty($docName) || empty($senderOrRecipient) || empty($sendOrReceiveDate) || empty($description)) {
    echo "All fields are required.";
    exit();
}

// Handle file upload
$attachment = null; // Initialize attachment variable
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
    // Validate the file type (ensure it's a PDF)
    $fileExtension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
    if (strtolower($fileExtension) !== 'pdf') {
        echo "Only PDF files are allowed.";
        exit();
    }

    // Validate the file size (e.g., max size: 5MB)
    if ($_FILES['attachment']['size'] > 20 * 1024 * 1024) {
        echo "File size exceeds the maximum allowed size of 20MB.";
        exit();
    }

    // Generate a UUID for the file
    $uuid = uniqid('', true);

    // Define the upload directory (make sure this directory is writable)
    $uploadDir = '/var/www/html/somio/uploads/'; // You may want to create this directory in your project folder
    $uploadFile = $uploadDir . $uuid . '.' . $fileExtension;
    
    // Move the uploaded file to the server directory
    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadFile)) {
        // Successfully uploaded file, save the UUID to the database
        $attachment = $uuid . '.' . $fileExtension;
    } else {
        echo "File upload failed.";
        exit();
    }
} else {
    echo "No file uploaded or there was an error with the file.";
    exit();
}

try {
    // Prepare the SQL query for insertion
    $stmt = $pdo->prepare("INSERT INTO records (type, dname, srcdes, date, remarks, link, creation_timestamp)
                           VALUES (:docType, :dName, :senderOrRecipient, :sendOrReceiveDate, :description, :attachment, CURRENT_TIMESTAMP)");

    // Bind parameters
    $stmt->bindParam(':docType', $formType);
    $stmt->bindParam(':dName', $docName);
    $stmt->bindParam(':senderOrRecipient', $senderOrRecipient);
    $stmt->bindParam(':sendOrReceiveDate', $sendOrReceiveDate);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':attachment', $attachment);

    // Execute the query
    $stmt->execute();

    echo "Record inserted successfully!";
} catch (PDOException $e) {
    // Handle and log errors
    error_log($e->getMessage());
    echo "Error inserting record: " . $e->getMessage();
}
?>
