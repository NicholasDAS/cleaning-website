<?php
session_start();

// Load database connection
require __DIR__ . "/../config.php";

// Reject direct access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../booking.html");
    exit();
}

// Collect form values
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$service = $_POST['service'];
$date = $_POST['date'];
$notes = $_POST['notes'];

// Save to Database
$stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, address, service, date, notes) 
VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $phone, $address, $service, $date, $notes);
$stmt->execute();

//  auto login user after booking
$_SESSION["user"] = $email;
$_SESSION["name"] = $name;

// Load PHPMailer
require __DIR__ . "/../email_config.php";

// Admin Notification
sendEmail(
    "edakinicholas9@gmail.com",
    "New Booking Received",
    "
        <h2>New Booking Request</h2>
        <strong>Name:</strong> $name<br>
        <strong>Email:</strong> $email<br>
        <strong>Phone:</strong> $phone<br>
        <strong>Address:</strong> $address<br>
        <strong>Service:</strong> $service<br>
        <strong>Date:</strong> $date<br>
        <strong>Notes:</strong> $notes
    "
);

// Customer Email
sendEmail(
    $email,
    "Booking Confirmation",
    "
        Hello $name,<br><br>
        Thank you for booking with <strong>Fabulous Cleaning Services</strong>.<br>
        We received your request and will contact you shortly.<br><br>

        📍 Toronto, Ontario, Canada <br>
        📞 (416) 555-9012 <br>
        📧 edakinicholas@gmail.com <br>
        🕒 Mon–Sat: 8:00 AM – 7:00 PM<br><br>

        <em>Fabulous Cleaning Team</em>
    "
);

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Booking Successful</title>

  <!-- Redirect to dashboard in 5 seconds -->
  <meta http-equiv="refresh" content="5;url=../dashboard.php">

  <style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #ffffff, #ffe8b3);
    font-family: Arial, sans-serif;
  }

  .success-box {
    background: white;
    padding: 40px;
    width: 500px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
    animation: fadeIn 0.7s ease-in-out;
  }

  h1 {
    color: #c79a00;
    font-size: 28px;
    margin-bottom: 10px;
  }

  p {
    color: #444;
    font-size: 17px;
    line-height: 1.6;
  }

  .loader {
    border: 6px solid #ddd;
    border-top: 6px solid #c79a00;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    margin: 20px auto;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0.9);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  a {
    color: red;
    font-weight: bold;
  }
  </style>

</head>

<body>

  <div class="success-box">
    <h1>Booking Successful!</h1>

    <p>
      Thank you, <strong><?php echo $name; ?></strong>.<br>
      Your booking has been successfully received.
    </p>

    <p>
      You will be redirected to your dashboard in <strong>5 seconds</strong>.
      <br><br>
      Or click here: <a href="../dashboard.php">Go to Dashboard</a>
    </p>

    <div class="loader"></div>
  </div>

</body>

</html>