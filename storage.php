<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit;
}

// Function to recursively scan a directory for MP4 files
function scanDirectoryForMP4($dir) {
    $result = [];

    // Open the directory
    $files = scandir($dir);

    // Loop through the files and directories
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $path = $dir . '/' . $file;

            // If it's a directory, recursively scan it
            if (is_dir($path)) {
                $result = array_merge($result, scanDirectoryForMP4($path));
            } else {
                // If it's an MP4 file, add it to the result array
                if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) == 'mp4') {
                    $result[] = $path;
                }
            }
        }
    }

    return $result;
}

// Directory to scan
$mainFolder = 'Main';

// Scan the main folder for MP4 files
$mp4Files = scanDirectoryForMP4($mainFolder);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage</title>
    <style>
        body {
            background-color: #000; /* Black background color */
            color: #fff; /* White text color */
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .grid-item video {
            width: 100%;
            height: auto;
        }

        .share-button {
            background-color: #007bff; /* Blue button */
            color: #fff; /* White text color */
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .share-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .back-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff; /* Blue button */
            color: #fff; /* White text color */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <h1>Storage</h1>
    <div class="grid-container">
        <?php
        // Display the MP4 files in a grid pattern
        foreach ($mp4Files as $mp4File) {
            echo '<div class="grid-item">';
            echo '<video controls><source src="' . $mp4File . '" type="video/mp4"></video>';
            echo '<button class="share-button" onclick="shareVideo(\'' . $mp4File . '\')">Share</button>';
            echo '</div>';
        }
        ?>
    </div>
    <button class="back-button" onclick="window.history.back()">Back</button>

    <script>
        function shareVideo(videoPath) {
            // Generate shareable link and copy to clipboard
            const sharedLink = window.location.origin + '/shared_video.php?video=' + encodeURIComponent(videoPath);
            navigator.clipboard.writeText(sharedLink)
                .then(() => alert('Link copied to clipboard: ' + sharedLink))
                .catch((error) => console.error('Unable to copy link: ', error));
        }
    </script>
</body>
</html>
