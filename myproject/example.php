<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Redirect Example</title>
</head>
<body>
    <div>
        <a href="#" class="email-link" data-email="example1@gmail.com">example1@gmail.com</a><br>
        <a href="#" class="email-link" data-email="example2@gmail.com">example2@gmail.com</a><br>
        <a href="#" class="email-link" data-email="example3@gmail.com">example3@gmail.com</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const emailLinks = document.querySelectorAll('.email-link');

            emailLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const email = this.getAttribute('data-email');
                    window.location.href = `https://mail.google.com/mail/?view=cm&fs=1&to=${email}`;
                });
            });
        });
    </script>
</body>
</html>