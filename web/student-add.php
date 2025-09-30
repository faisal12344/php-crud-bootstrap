<h3 class="mb-3">Add New Student</h3>

<form name="frmAdd" method="post" action="" class="card p-4 shadow-sm bg-white">
  <div class="mb-3">
    <label for="roll_number" class="form-label">Roll Number</label>
    <input type="text" name="roll_number" id="roll_number" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="name" class="form-label">Full Name</label>
    <input type="text" name="name" id="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" name="dob" id="dob" class="form-control">
  </div>

  <div class="mb-3">
    <label for="class" class="form-label">Class</label>
    <input type="text" name="class" id="class" class="form-control" required>
  </div>

  <button type="submit" name="add" class="btn btn-primary">Add Student</button>
  <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>