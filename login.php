<!DOCTYPE html>
<html>

<head>
    <title> </title>

    <link rel="stylesheet" href="login.css">
    <script src="Library/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" refererrerpolicy="no-referrer">
</head>

<body>
    <div class="container">
        <h1>Sign In</h1>
        <form class="form-login" action="proseslogin.php" method="POST">
            <div class="form-control">
                <input input class="input" type="text" id="username" name="username" required />
                <label class="control-label" for="username">Username</label>

            </div>

            <div class="form-control">
                <input class="input" type="password" id="password" name="password" required />
                <label class="control-label" for="password">Your Password</label>
            </div>
            <button class="btn">Submit </button>
            </p>
        </form>
    </div>
    <script>
        const labels = document.querySelectorAll(".form-login label");

        labels.forEach((label) => {
            label.innerHTML = label.innerText
                .split("")
                .map(
                    (letter, idx) =>
                    `<span style="transition-delay:${idx * 50}ms">${letter}</span>`
                )
                .join("");
        });
    </script>
</body>

</html>