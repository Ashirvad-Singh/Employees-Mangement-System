<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Employee ID not found in session.";
    exit();
}

$emp_id = $_SESSION['user_id'];

$employee_query = $conn->prepare("SELECT * FROM employees_tbl WHERE emp_id = ?");
$employee_query->bind_param("i", $emp_id);
$employee_query->execute();
$employee_result = $employee_query->get_result();
$employee = $employee_result->fetch_assoc();

if (!$employee) {
    echo "Employee not found.";
    exit();
}

$leave_requests_query = $conn->prepare("SELECT * FROM leave_requests WHERE employee_id = ?");
$leave_requests_query->bind_param("i", $emp_id);
$leave_requests_query->execute();
$leave_requests = $leave_requests_query->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    if (strtotime($start_date) > strtotime($end_date)) {
        $message = "Start date cannot be later than end date.";
    } else {
        $leave_request_query = $conn->prepare("INSERT INTO leave_requests (employee_id, start_date, end_date, reason, status) 
                                               VALUES (?, ?, ?, ?, 'pending')");
        $leave_request_query->bind_param("isss", $emp_id, $start_date, $end_date, $reason);
        if ($leave_request_query->execute()) {
            $message = "Leave request submitted successfully!";
        } else {
            $message = "Error submitting leave request: " . $conn->error;
        }
    }
}

?>

<?php require('header.php'); ?>
<title>Employee Dashboard</title>
<style>
    .profile-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>

<div class="p-6 max-w-5xl mx-auto">
    <?php if (isset($message)): ?>
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4"><?= htmlspecialchars($message); ?></div>
    <?php endif; ?>


    <div class="bg-white p-8 rounded-lg shadow-lg mb-6 flex items-center">
        <div class="mr-6">
            <img src="uploads/<?= htmlspecialchars($employee['emp_photo']) ?>" alt="Employee Photo" class="profile-photo border-4 border-blue-600 shadow-lg">
        </div>
        <div class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800"><?= htmlspecialchars($employee['emp_fullname']) ?></h2>
            <p class="text-gray-600"><strong>Email:</strong> <?= htmlspecialchars($employee['emp_email']) ?></p>
            <p class="text-gray-600"><strong>Phone:</strong> <?= htmlspecialchars($employee['emp_phone']) ?></p>
            <p class="text-gray-600"><strong>Address:</strong> <?= htmlspecialchars($employee['emp_address']) ?></p>
            <p class="text-gray-600"><strong>Role:</strong> <?= htmlspecialchars($employee['emp_designation']) ?></p>
            <p class="text-gray-600"><strong>Salary:</strong> ₹<?= number_format($employee['emp_basic_salary'], 2) ?></p>
            <p class="text-gray-600"><strong>Aadhar Card:</strong> <?= htmlspecialchars($employee['emp_aadhar_card']) ?></p>
            <p class="text-gray-600"><strong>PAN Card:</strong> <?= htmlspecialchars($employee['emp_pan_card']) ?></p>
        </div>
    </div>


    <h2 class="text-xl font-semibold mb-4">Leave Requests</h2>
    <?php if ($leave_requests->num_rows > 0): ?>
        <table class="w-full bg-gray-50 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-4 text-left">Start Date</th>
                    <th class="p-4 text-left">End Date</th>
                    <th class="p-4 text-left">Reason</th>
                    <th class="p-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($leave = $leave_requests->fetch_assoc()) {
                    $status_class = '';
                    $status_text = '';
                    
                    if ($leave['status'] == 'approved') {
                        $status_class = 'bg-green-500 text-white';
                        $status_text = 'Approved';
                    } elseif ($leave['status'] == 'rejected') {
                        $status_class = 'bg-red-500 text-white';
                        $status_text = 'Rejected';
                    } else {
                        $status_class = 'bg-yellow-500 text-white';
                        $status_text = 'Pending';
                    }
                ?>
                    <tr>
                        <td class="p-4"><?= htmlspecialchars($leave['start_date']) ?></td>
                        <td class="p-4"><?= htmlspecialchars($leave['end_date']) ?></td>
                        <td class="p-4"><?= htmlspecialchars($leave['reason']) ?></td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full <?= $status_class ?>">
                                <?= $status_text ?>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-gray-600">No leave requests found.</p>
    <?php endif; ?>

   
    <h2 class="text-xl font-semibold my-6">Request Leave</h2>
    <form action="employee_dashboard.php" method="post" class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid md:grid-cols-2 md:gap-6">
            <input type="date" name="start_date" class="mt-1 mb-4 p-2 border border-gray-300 rounded w-full" placeholder="Start Date" required>
            <input type="date" name="end_date" class="mt-1 mb-4 p-2 border border-gray-300 rounded w-full" placeholder="End Date" required>
        </div>
        <label class="block text-sm font-medium text-gray-700">Reason</label>
        <textarea name="reason" class="mt-1 mb-4 p-2 border border-gray-300 rounded w-full" required></textarea>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Submit</button>
    </form>
</div>

</body>
</html>
