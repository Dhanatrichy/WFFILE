<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            margin: 0 auto;
            max-width: 400px;
        }

        .form-group {
            margin: 10px 0;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>File Upload Form</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
                <label for="file_type">File Type:</label>
                <input type="text" name="file_type" id="file_type" required>
        
            
            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" name="file" id="file" required>
            </div>
            </div>
            <div class="form-group">
                <label for="page_size">Page Size:</label>
                <input type="text" name="page_size" id="page_size" required>
            </div>
            
            <div class="form-group">
                <label for="page_orientation">Page Orientation:</label>
                <input type="text" name="page_orientation" id="page_orientation" required>
            </div>
            <div class="form-group">
                <label for="upload_date">Upload Date:</label>
                <input type="date" name="upload_date" id="upload_date" required>
            </div>
            
            <div class="form-group">
                <label for="uploader_name">Uploader Name:</label>
                <input type="text" name="uploader_name" id="uploader_name" required>
            </div>
            
            <div class="form-group">
                <button type="submit">Upload File</button>
            </div>
        </form>
    </div>
</body>
</html>
