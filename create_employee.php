<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<?php require('header.php'); ?>
<title>Create Employee</title>
<div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Create Employee</h1>
    <form action="create_employee_process.php" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="emp_fullname" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required pattern="[A-Za-z\s]+" title="Full Name must only contain letters and spaces.">
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_fullname']) ? $error['emp_fullname'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Father's Name</label>
                <input type="text" name="emp_fathername" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required pattern="[A-Za-z\s]+" title="Father's Name must only contain letters and spaces.">
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_fathername']) ? $error['emp_fathername'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="emp_date_of_birth" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required max="2005-01-01" title="Date of Birth must be before January 1, 2005.">
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_date_of_birth']) ? $error['emp_date_of_birth'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="emp_gender" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_gender']) ? $error['emp_gender'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contact</label>
                <input type="tel" name="emp_phone" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required pattern="^\d{10}$" title="Contact must be a valid 10-digit phone number.">
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_phone']) ? $error['emp_phone'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="emp_email" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_email']) ? $error['emp_email'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="emp_address" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_address']) ? $error['emp_address'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Department</label>
                <select name="emp_department" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Select Department</option>
                    <option value="Development">Development</option>
                    <option value="Designer">Designer</option>
                    <option value="HR">HR</option>
                    <option value="Marketing">Marketing</option>
                </select>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_department']) ? $error['emp_department'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Designation</label>
                <select name="emp_designation" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Select Designation</option>
                    <option value="Web Developer">Web Developer</option>
                    <option value="Web Designer">Web Designer</option>
                    <option value="Graphics Designer">Graphics Designer</option>
                    <option value="Intern">Intern</option>
                    <option value="BDE">BDE</option>
                    <option value="SEO">SEO</option>
                </select>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_designation']) ? $error['emp_designation'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date of Joining</label>
                <input type="date" name="emp_date_of_joining" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_date_of_joining']) ? $error['emp_date_of_joining'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Office Exit Date</label>
                <input type="date" disabled name="emp_office_exit_date" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Basic Salary</label>
                <input type="number" name="emp_basic_salary" step="0.01" min="0" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_basic_salary']) ? $error['emp_basic_salary'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Bank Account Holder Name</label>
                <input type="text" name="emp_acc_holder_name" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_acc_holder_name']) ? $error['emp_acc_holder_name'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Bank Account Number</label>
                <input type="text" name="emp_acc_num" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required pattern="\d+" title="Bank Account Number must contain only numbers.">
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_acc_num']) ? $error['emp_acc_num'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">IFSC Code</label>
                <input type="text" name="emp_ifsc_code" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required pattern="^[A-Za-z]{4}\d{7}$" title="IFSC Code must follow the pattern: 4 letters followed by 7 digits.">
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_ifsc_code']) ? $error['emp_ifsc_code'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Aadhar Card</label>
                <input type="text" name="emp_aadhar_card" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required pattern="\d{12}" title="Aadhar Card must be a 12-digit number.">
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_aadhar_card']) ? $error['emp_aadhar_card'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">PAN Card</label>
                <input type="text" name="emp_pan_card" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" required pattern="[A-Z]{5}\d{4}[A-Z]" title="PAN Card must follow the pattern: 5 letters, 4 digits, and 1 letter.">
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_pan_card']) ? $error['emp_pan_card'] : ''; ?></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">User Name</label>
                <input type="text" name="username" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" title="PAN Card must follow the pattern: 5 letters, 4 digits, and 1 letter.">
                <span class="text-red-500 text-xs"><?php echo isset($error['username']) ? $error['username'] : ''; ?></span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="text" name="password" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>


            <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="emp_photo" class="mt-1 mb-4 p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500" accept="image/*" required>
                <span class="text-red-500 text-xs"><?php echo isset($error['emp_photo']) ? $error['emp_photo'] : ''; ?></span>
            </div>

            <div class="col-span-2 text-center">
                <button type="submit" name="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create Employee</button>
            </div>
        </div>
    </form>
</div>


