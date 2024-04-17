<?php
// Check if the video parameter exists in the URL
if (!isset($_GET['video'])) {
    // Redirect to storage.php if video parameter is missing
    header("Location: storage.php");
    exit;
}

// Extract the video path from the URL parameter
$videoPath = urldecode($_GET['video']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AidenTube</title>
    <style>
        body {
            background-color: #000; /* Black background color */
            color: #fff; /* White text color */
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        video {
            width: 60%; /* Adjust the width as needed */
            height: auto;
            margin: 0 auto; /* Center the video horizontally */
            display: block; /* Ensure the video is displayed as a block element */
        }
    </style>
</head>
<body>
    <h1>AidenTube</h1>
    <div>
        <video controls><source src="<?php echo $videoPath; ?>" type="video/mp4"></video>
    </div>
</body>
</html>
