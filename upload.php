<?php
if(isset($_POST['submitImage']))
{
    $folder = "Images/";
    
    // Check if any files were uploaded
    if(isset($_FILES["upload"]) && is_array($_FILES["upload"]["name"])) {
        foreach($_FILES["upload"]["tmp_name"] as $key => $tmp_name) {
            $uploadfile = $folder . $_FILES["upload"]["name"][$key];
            
            // Check if the file is an actual uploaded file and not a malicious request
            if(is_uploaded_file($tmp_name)) {
                // Check file extension
                $fileExtension = pathinfo($uploadfile, PATHINFO_EXTENSION);
                $allowedExtensions = array("jpg", "jpeg", "png", "gif",); // Add more if needed
                if(in_array(strtolower($fileExtension), $allowedExtensions)) {
                    move_uploaded_file($tmp_name, $uploadfile);
                } else {
                    // Handle error for invalid file extensions
                    echo "Invalid file format. Only images are allowed.";
                }
            } else {
                // Handle error for potential hacking attempt or other issues with file upload
                echo "Error uploading file.";
            }
        }
    }
}

// Redirect back to the previous page
if(isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
