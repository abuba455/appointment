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
