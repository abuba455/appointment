<?php
// Create a hashmap to store clinic appointments
$clinicAppointments = [];

// Function to add an appointment
function addAppointment(&$appointments, $time, $doctor, $nurse) {
    $appointments[$time] = ['doctor' => $doctor, 'nurse' => $nurse];
}

// Add appointments
addAppointment($clinicAppointments, '2023-10-03 09:00 AM', 'Dr. Smith', 'Nurse Johnson');
addAppointment($clinicAppointments, '2023-10-03 10:30 AM', 'Dr. Patel', 'Nurse Williams');
addAppointment($clinicAppointments, '2023-10-03 02:15 PM', 'Dr. Davis', 'Nurse Jones');

// Function to find appointments by staff member name (case-insensitive)
function findAppointmentsByStaff(&$appointments, $staffName) {
    $staffName = strtolower($staffName);
    $foundAppointments = [];

    foreach ($appointments as $time => $appointment) {
        if (in_array($staffName, array_map('strtolower', $appointment))) {
            $foundAppointments[$time] = $appointment;
        }
    }

    return $foundAppointments;
}

// Look up appointments for a staff member (case-insensitive)
$staffMember = 'Dr. Smith'; // Case-insensitive lookup
$foundAppointments = findAppointmentsByStaff($clinicAppointments, $staffMember);

// Display found appointments
if (!empty($foundAppointments)) {
    echo "Appointments for $staffMember:\n";
    foreach ($foundAppointments as $time => $appointment) {
        echo "Time: $time\n";
        echo "Doctor: " . $appointment['doctor'] . "\n";
        echo "Nurse: " . $appointment['nurse'] . "\n\n";
    }
} else {
    echo "No appointments found for $staffMember.\n";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointments</title>
</head>
<body>
    <h1>Clinic Appointments</h1>

    <!-- Form to add an appointment -->
    <h2>Add an Appointment</h2>
    <form method="post">
        <label for="appointmentTime">Appointment Time:</label>
        <input type="text" id="appointmentTime" name="appointmentTime" required>
        <br>

        <label for="doctorName">Doctor's Name:</label>
        <input type="text" id="doctorName" name="doctorName" required>
        <br>

        <label for="nurseName">Nurse's Name:</label>
        <input type="text" id="nurseName" name="nurseName" required>
        <br>

        <button type="submit" name="addAppointment">Add Appointment</button>
    </form>

    <!-- Form to find appointments by staff -->
    <h2>Find Appointments by Staff</h2>
    <form method="post">
        <label for="staffMember">Staff Member's Name:</label>
        <input type="text" id="staffMember" name="staffMember" required>
        <br>

        <button type="submit" name="findAppointments">Find Appointments</button>
    </form>

    <!-- Display found appointments -->
    <?php if (isset($foundAppointments)) : ?>
        <h2>Appointments Found</h2>
        <?php if (empty($foundAppointments)) : ?>
            <p>No appointments found for the specified staff member.</p>
        <?php else : ?>
            <ul>
                <?php foreach ($foundAppointments as $time => $appointment) : ?>
                    <li>
                        <strong>Time:</strong> <?php echo $time; ?><br>
                        <strong>Doctors:</strong> <?php echo implode(', ', $appointment['doctors']); ?><br>
                        <strong>Nurses:</strong> <?php echo implode(', ', $appointment['nurses']); ?><br>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
