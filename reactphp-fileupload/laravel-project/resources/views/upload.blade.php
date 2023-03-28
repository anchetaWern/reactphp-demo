<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
</head>
<body>
    <div class="p-5">
        <form 
            action="http://localhost:8080"
            method="POST"
            enctype="multipart/form-data">

            <div>
                <label for="file" class="form-label">Upload File</label>
                <input class="form-control form-control-lg" id="file" name="file" type="file">
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-lg btn-primary">
                    Submit
                </button>
            </div>

        </form>
    </div>
</body>
</html>