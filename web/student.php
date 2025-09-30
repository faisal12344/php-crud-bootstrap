
<h3 class="mb-3">Student List</h3>

<div class="mb-3">
  <a href="index.php?action=student-add" class="btn btn-success">
    + Add New Student
  </a>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Roll Number</th>
        <th>Full Name</th>
        <th>Date of Birth</th>
        <th>Class</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($result)) { ?>
        <?php foreach ($result as $row) { ?>
          <tr>
            <td><?= $row["id"]; ?></td>
            <td><?= htmlspecialchars($row["roll_number"]); ?></td>
            <td><?= htmlspecialchars($row["name"]); ?></td>
            <td><?= htmlspecialchars($row["dob"]); ?></td>
            <td><?= htmlspecialchars($row["class"]); ?></td>
            <td>
              <a href="index.php?action=student-edit&id=<?= $row["id"]; ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="index.php?action=student-delete&id=<?= $row["id"]; ?>" 
                 class="btn btn-sm btn-danger"
                 onclick="return confirm('Are you sure you want to delete this student?');">
                 Delete
              </a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="6" class="text-center text-muted">No students found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>