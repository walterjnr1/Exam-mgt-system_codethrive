<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OTP Verification</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    .otp-input {
      width: 60px;
      height: 60px;
      font-size: 24px;
      text-align: center;
      margin: 0 5px;
    }
  </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card p-4 shadow-lg" style="max-width: 700px; width: 100%; height:40% " >
    <h4 class="text-center mb-4">Enter OTP Code to complete your registration </h4>
    <form action="validate_otp.php" method="POST" id="otpForm">
      <div class="d-flex justify-content-center mb-3">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 0)">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 1)">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 2)">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 3)">
        <input type="text" name="otp[]" maxlength="1" class="form-control otp-input" oninput="moveToNext(this, 4)">
      </div>
      <div class="d-grid">
          <button type="submit" name="btnverify" class="btn btn-primary">Verify</button>
        </div>
          </form>
  </div>

  <script>
    function moveToNext(input, index) {
      const inputs = document.querySelectorAll('.otp-input');
      if (input.value.length === 1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }
    }
  </script>

</body>
</html>
