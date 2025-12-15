<?php
// ================================
// PROCESS FORM SUBMISSION
// ================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require "config.php";   // <-- DB connection
    require "email_config.php"; // <-- PHPMailer

    // Collect form values safely
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $phone   = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // Save into database
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    $stmt->execute();

    // email to admin
    sendEmail(
        "edakinicholas9@gmail.com",
        "New Contact Message Received",
        "
            <h2>New Contact Message</h2>
            <strong>Name:</strong> $name<br>
            <strong>Email:</strong> $email<br>
            <strong>Phone:</strong> $phone<br>
            <strong>Message:</strong> $message
        "
    );

    // confirmation to customer
    sendEmail(
        $email,
        "We Received Your Message",
        "
            Hello $name,<br><br>
            Thank you for contacting <strong>Fabulous Cleaning Services</strong>.<br>
            We have received your message and will reply shortly.<br><br>

            📍 Toronto, Ontario, Canada <br>
            📞 (416) 555-9012 <br>
            📧 edakinicholas@gmail.com <br>
            🕒 Mon–Sat: 8:00 AM – 7:00 PM <br><br>

            <em>Fabulous Cleaning Team</em>
        "
    );
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <title>Message Sent</title>

  <!-- Redirect in 59 seconds -->
  <meta http-equiv='refresh' content='59;url=contact.html'>

  <style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #f7f7f7, #e8e8e8);
    font-family: Arial, Helvetica, sans-serif;
  }

  .success-box {
    background: white;
    width: 450px;
    padding: 40px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
    animation: fadeIn 0.7s ease-in-out;
  }

  .success-box h1 {
    color: #28a745;
    font-size: 30px;
    margin-bottom: 10px;
  }

  .success-box p {
    font-size: 18px;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.5;
  }

  .loader {
    border: 6px solid #ddd;
    border-top: 6px solid #28a745;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    margin: 20px auto;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }

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

  .redirect-text {
    font-size: 14px;
    color: #666;
    margin-top: 20px;
  }
  </style>
</head>

<body>

  <div class='success-box'>
    <h1>Message Sent Successfully!</h1>

    <p>
      Thank you, <strong><?php echo htmlspecialchars($name); ?></strong>!<br>
      Your message has been received and our team will reach out shortly.<br><br>

      <?php if (!empty($phone)): ?>
      We will also contact you on WhatsApp if your number is active. 📱
      <?php endif; ?>
    </p>

    <div class='loader'></div>

    <p class='redirect-text'>
      Redirecting you back to the Contact Page in <strong>59 seconds…</strong>
    </p>
  </div>

</body>

</html>