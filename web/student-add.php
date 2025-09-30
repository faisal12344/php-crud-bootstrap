<?php require_once __DIR__ . '/header.php'; ?>

<h3 class="mb-3">Add New Student</h3>

<form method="post" action="" class="card bg-secondary-subtle text-white p-4 shadow-sm">
  <div class="mb-3">
    <label class="form-label" for="name">Full Name</label>
    <input class="form-control" type="text" id="name" name="name" required>
  </div>

  <div class="mb-3">
    <label class="form-label" for="roll_number">Roll Number</label>
    <input class="form-control" type="number" id="roll_number" name="roll_number" required>
  </div>

  <div class="mb-3">
    <label class="form-label" for="dob">Date of Birth</label>
    <input class="form-control" type="date" id="dob" name="dob">
  </div>

  <div class="mb-3">
    <label class="form-label" for="class">Class</label>
    <input class="form-control" type="text" id="class" name="class" required>
  </div>

  <button class="btn btn-primary" type="submit" name="add">Save</button>
  <a class="btn btn-outline-light" href="index.php">Cancel</a>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>