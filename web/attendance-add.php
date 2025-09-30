<?php require_once __DIR__ . '/header.php'; ?>
<?php $today = date('Y-m-d'); ?>

<h3 class="mb-3">Add Attendance</h3>

<form method="post" action="" class="card bg-secondary-subtle text-white p-3 shadow-sm mb-3">
  <div class="row g-3 align-items-center">
    <div class="col-auto">
      <label class="col-form-label" for="attendance_date">Date</label>
    </div>
    <div class="col-auto">
      <input class="form-control" type="date" id="attendance_date" name="attendance_date" value="<?= $today ?>" required>
    </div>
  </div>
</form>

<form method="post" action="" class="card bg-secondary-subtle text-white p-3 shadow-sm">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-dark align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Full Name</th>
          <th>Roll Number</th>
          <th style="width:280px">Mark</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($studentResult)) { ?>
          <?php foreach ($studentResult as $row) { $sid = (int)$row['id']; ?>
            <tr>
              <td><?= $sid ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['roll_number']) ?></td>
              <td>
                <input type="hidden" name="student_id[]" value="<?= $sid ?>">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="attendance-<?= $sid ?>" id="p<?= $sid ?>" value="present" required>
                  <label class="form-check-label" for="p<?= $sid ?>">Present</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="attendance-<?= $sid ?>" id="a<?= $sid ?>" value="absent">
                  <label class="form-check-label" for="a<?= $sid ?>">Absent</label>
                </div>
              </td>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <tr><td colspan="4" class="text-center text-muted">No students found.</td></tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <input type="hidden" name="attendance_date" value="<?= $today ?>">
  <button class="btn btn-primary" type="submit" name="add">Save</button>
  <a class="btn btn-outline-light" href="index.php?action=attendance">Cancel</a>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>