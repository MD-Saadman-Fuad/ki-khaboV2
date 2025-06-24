    <?php include('partials-frontend/menu.php') ?>

    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 0px;
        }
        .contact-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        .social-links img {
            width: 40px;
            margin: 10px;
            transition: transform 0.3s;
        }
        .social-links img:hover {
            transform: scale(1.2);
        }
        .email {
            font-size: 18px;
            margin-top: 20px;
        }
        .email a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .email a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="contact-container main main-content bg-gradient-to-br from-orange-200 via-amber-50 to-yellow-50">
        <h2>Contact Me</h2>
        <p>Feel free to reach out through my socials or email.</p>
        <?php include('partials-frontend/footer.php') ?>
        <div class="email">
            Email: <a href="mailto:md.saadman.fuad@gmail.com">md.saadman.fuad@gmail.com</a>
        </div>
    </div>

</html>


