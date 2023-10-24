<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
    <style>
        /* Add your CSS styles here for table formatting */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Add more CSS styles as needed */
    </style>
</head>
<body>
    <h1>File List</h1>
    <a href="{{ route('fileUploads.create') }}">Add</a> <!-- Replace with your add route -->

    <table>
        <thead>
            <tr>
                <th>Page name</th>
                <th>Page Size</th>
                <th>Page Orientation</th>
                <th>File Name</th>
                <th>Upload Date</th>
                <th>Uploader Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                <td>{{ $file->page_name }}</td>
                    <td>{{ $file->page_size }}</td>
                    <td>{{ $file->page_orientation }}</td>
                    <td>{{ $file->file_name }}</td>
                    <td>{{ $file->upload_date }}</td>
                    <td>{{ $file->uploader_name }}</td>
                    <td>
                        <a href="{{ route('fileDownload', $file->id) }}">Download</a>
                       
                        <!-- Add a delete button here -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
