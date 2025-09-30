<?php require_once __DIR__ . '/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Student List</h3>
  <a href="index.php?action=student-add" class="btn btn-success">+ Add New Student</a>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-dark align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Roll Number</th>
        <th>Full Name</th>
        <th>Date of Birth</th>
        <th>Class</th>
        <th style="width:160px">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($result)) { ?>
        <?php foreach ($result as $row) { ?>
          <tr>
            <td><?= (int)$row['id'] ?></td>
            <td><?= htmlspecialchars($row['roll_number']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['dob']) ?></td>
            <td><?= htmlspecialchars($row['class']) ?></td>
            <td>
              <a class="btn btn-sm btn-warning" href="index.php?action=student-edit&id=<?= (int)$row['id'] ?>">Edit</a>
              <a class="btn btn-sm btn-danger"
                 onclick="return confirm('Delete this student?')"
                 href="index.php?action=student-delete&id=<?= (int)$row['id'] ?>">Delete</a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr><td colspan="6" class="text-center text-muted">No students found.</td></tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>