<?php require_once __DIR__ . '/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Attendance</h3>
  <a href="index.php?action=attendance-add" class="btn btn-dark">+ Add Attendance</a>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-dark align-middle">
    <thead>
      <tr>
        <th>Date</th>
        <th>Present</th>
        <th>Absent</th>
        <th style="width:180px">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($result)) { ?>
        <?php foreach ($result as $row) {
          $date    = $row['attendance_date'] ?? $row['date'] ?? '';
          $present = (int)($row['present'] ?? $row['present_count'] ?? $row['presentTotal'] ?? 0);
          $absent  = (int)($row['absent']  ?? $row['absent_count']  ?? $row['absentTotal']  ?? 0);
        ?>
          <tr>
            <td><?= htmlspecialchars($date) ?></td>
            <td><?= $present ?></td>
            <td><?= $absent ?></td>
            <td>
              <a class="btn btn-sm btn-warning"
                 href="index.php?action=attendance-edit&date=<?= urlencode($date) ?>">Edit</a>
              <a class="btn btn-sm btn-danger"
                 onclick="return confirm('Delete records for this date?')"
                 href="index.php?action=attendance-delete&date=<?= urlencode($date) ?>">Delete</a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr><td colspan="4" class="text-center text-muted">No attendance records.</td></tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>