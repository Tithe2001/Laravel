<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Greeting</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- Greeting Card -->
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h1 class="card-title mb-3">Hello, <span id="userName">User</span>!</h1>
            <p class="card-text lead">Welcome back to our website. We're glad to see you again!</p>
            <a href="#" class="btn btn-primary mt-3">Go to Dashboard</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional: JS to dynamically set the user name -->
  <script>
    // Replace 'John' with the logged-in user's name dynamically
    const userName = "John";
    document.getElementById("userName").textContent = userName;
  </script>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
