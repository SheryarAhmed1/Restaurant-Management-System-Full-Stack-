<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #mapBox {
            width: 100%;
            height: 450px;
            border-radius: 10px;
            background: #e9ecef;
        }
        #color {
            background-color: lightgray;
        }
        body{
            background-color:#c8d2cfff;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-5 fw-bold">Contact Us</h1>
        <div class="row g-4">
            <div class="col-md-6">
                <div id="mapBox">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2349.1832859264237!2d73.01036735192206!3d33.624840611923275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38df9561a306c0c5%3A0x99ad4f0420137e87!2sNational%20University%20of%20Technology%20(NUTECH)!5e0!3m2!1sen!2s!4v1763203976283!5m2!1sen!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" width="100%" height="100%"
                        style="border:0"></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <form id="contactForm" class="p-4 bg-white shadow-sm rounded">

                    <label class="fw-semibold">Name</label>
                    <input type="text" class="form-control mb-3" id="name" required>

                    <label class="fw-semibold">Email</label>
                    <input type="email" class="form-control mb-3" id="email" required>

                    <label class="fw-semibold">Message</label>
                    <textarea class="form-control mb-3" id="message" rows="5" required></textarea>

                    <button class="btn btn-primary px-4">Submit</button>
                    <p id="submit" class="text-success mt-3" style="display:none;">
                        Your request submitted
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("contactForm").addEventListener("submit", function (msg) {
            msg.preventDefault();
            document.getElementById("submit").style.display = "block";
        });
    </script>
</body>
</html>