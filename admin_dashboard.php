<?php
session_start();
include "config.php";

if ($_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

$employees_count = $conn
    ->query("SELECT COUNT(*) AS total FROM employees_tbl")
    ->fetch_assoc()["total"];
$total_salary = $conn
    ->query("SELECT SUM(emp_basic_salary) AS total FROM employees_tbl")
    ->fetch_assoc()["total"];
$leave_requests = $conn->query("
    SELECT leave_requests.*, employees_tbl.emp_fullname AS name 
    FROM leave_requests
    JOIN employees_tbl ON leave_requests.employee_id = employees_tbl.emp_id
");
?>
<?php require('header.php');?>

<title>Admin Dashboard</title>

<section class="bg-gray-50 dark:bg-gray-900 p-6 sm:p-8">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <h1 class="text-3xl font-bold text-blue-600 mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Total Employees</h2>
                <p class="text-2xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"><?= $employees_count ?></p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Total Salary</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">₹<?= number_format($total_salary, 2) ?></p>
            </div>
        </div>
    </div>
</section>


    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add Product
                    </button>
                </div>
            </div>
            <h2 class="text-2xl font-semibold mb-4 px-4 py-2">Leave Requests</h2>
            <div class="overflow-x-auto px-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Employee</th>
                            <th class="px-4 py-3">Start Date</th>
                            <th class="px-4 py-3">End Date</th>
                            <th class="px-4 py-3">Reason</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($leave = $leave_requests->fetch_assoc()) { ?>
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3"><?= htmlspecialchars($leave["name"]) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($leave["start_date"]) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($leave["end_date"]) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($leave["reason"]) ?></td>
                                <td class="px-4 py-3"><?= ucfirst(htmlspecialchars($leave["status"])) ?></td>
                                <td class="px-4 py-3">
                                    <?php if ($leave["status"] == "pending") { ?>
                                        <a href="update_leave_status.php?id=<?= $leave["id"] ?>&action=approve" class="text-green-600">Approve</a> |
                                        <a href="update_leave_status.php?id=<?= $leave["id"] ?>&action=reject" class="text-red-600">Reject</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

</div>
</body>
</html>
