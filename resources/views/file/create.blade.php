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
        input[type="date"],
        select {
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
        <form action="{{ url('fileUploads') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Include the CSRF token -->

            <div class="form-group">
                <label for="page_name">Page Name :</label>
                <input type="text" name="page_name" id="page_name" required>
            </div>

            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" name="file" id="file" accept=".pdf, .xls, .xlsx, .doc, .docx" required>
            </div>

            <div class="form-group">
                <label for="page_size">Page Size:</label>
                <select name="page_size" id="page_size" required>
                    <option value="A4">A4</option>
                    <option value="A3">A3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="page_orientation">Page Orientation:</label>
                <select name="page_orientation" id="page_orientation" required>
                    <option value="portrait">Portrait</option>
                    <option value="landscape">Landscape</option>
                </select>
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
                <a href="{{ route('fileUploads.index') }}"> <button type="button"> Back</button></a>
            </div>
        </form>
    </div>
</body>

</html>