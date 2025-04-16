<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OTP Verification</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin-top: 100px;
    }
    input[type="text"] {
      width: 40px;
      font-size: 24px;
      text-align: center;
      margin: 5px;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      font-size: 16px;
    }
  </style>
</head>
<body>

  <h2>Enter Your 5-Digit OTP</h2>

  <form action="validate_otp.php" method="POST">
    <input type="text" name="digit1" maxlength="1" required>
    <input type="text" name="digit2" maxlength="1" required>
    <input type="text" name="digit3" maxlength="1" required>
    <input type="text" name="digit4" maxlength="1" required>
    <input type="text" name="digit5" maxlength="1" required>
    <br>
    <button type="submit">Verify OTP</button>
  </form>

</body>
</html>
