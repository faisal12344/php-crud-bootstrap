<?php require_once __DIR__ . '/header.php'; ?>

<?php
$attendanceMap = [];
if (!empty($result)) {
  foreach ($result as $row) {
    $sid = (int)($row['student_id'] ?? 0);
    if ($sid) {
      if (!empty($row['present']))      $attendanceMap[$sid] = 'present';
      elseif (!empty($row['absent']))   $attendanceMap[$sid] = 'absent';
      else                               $attendanceMap[$sid] = '';
    }
  }
}
$date = htmlspecialchars($_GET['date'] ?? '');
?>

<h3 class="mb-3">Edit Attendance – <?= $date ?></h3>

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
          <?php foreach ($studentResult as $row) {
            $sid = (int)$row['id'];
            $mark = $attendanceMap[$sid] ?? '';
          ?>
            <tr>
              <td><?= $sid ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['roll_number']) ?></td>
              <td>
                <input type="hidden" name="student_id[]" value="<?= $sid ?>">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"
                         name="attendance-<?= $sid ?>" id="p<?= $sid ?>" value="present"
                         <?= $mark === 'present' ? 'checked' : '' ?> required>
                  <label class="form-check-label" for="p<?= $sid ?>">Present</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"
                         name="attendance-<?= $sid ?>" id="a<?= $sid ?>" value="absent"
                         <?= $mark === 'absent' ? 'checked' : '' ?>>
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

  <button class="btn btn-primary" type="submit" name="add">Save</button>
  <a class="btn btn-outline-light" href="index.php?action=attendance">Cancel</a>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>