<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>

    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
        }

        .btn-primary {
            width: 100%;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <!-- Form Container -->
        <div class="form-container">
            <h1>Edit Category</h1>

            <!-- Edit Category Form -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>

            <!-- Back Link -->
            <div class="back-link mt-3 text-center">
                <a href="{{ route('categories.index') }}">← Back to Categories List</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
