<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>About Us</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<style> 
/* about.css */

/* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}
  
.bg {
    background-color: white;
}
  
.bg-img {
    position: relative;
    width: 100%;
    height: 500px; /* Adjust the height to match the image */
}
  
.background-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image covers the entire container */
}
  
.overlay-text {
    position: absolute;
    top: 45%;
    left: 22%;
    transform: translate(-50%, -50%);
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-size: 80px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}
  
.overlay-texts {
    position: absolute;
    top: 57%;
    left: 22%;
    transform: translate(-50%, -50%);
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-size: 80px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}
  
.about-text {
    margin-top: 50px;
    padding: 20px;
    background-color: #f8f9fa; 
    border-radius: 10px; 
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); 
    margin-bottom: 50px;
}
  
.about-text h3 {
    font-size: 40px;
    text-transform: uppercase;
    margin-bottom: 20px; 
    color: #333; 
}
  
.about-text h4 {
    font-size: 30px;
    text-transform: uppercase;
    margin-top: 30px; 
    margin-bottom: 15px; 
    color: #333; 
}
  
.about-text p {
    font-size: 20px;
    line-height: 1.6;
    margin-bottom: 15px; 
    color: #555;
}
  
.about-text a {
    color: #007bff; 
}
  
.about-text a:hover {
    text-decoration: underline;
}
  
.end {
    color: black;
    font-weight: bold;

    .navbar-brand {
  margin-right: 20px; /* Adjust as needed */
}
}
</style>
</head>
<body>
    <?php   

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/gernalapp">Note App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/gernalapp/note.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/gernalapp/about.php">About us</a>
        </li>
       
      </ul>
';

echo '<ul class="navbar-nav ml-auto">';

if ($loggedin) {
  echo '
    <li class="nav-item">
      <a class="btn btn-danger" href="/gernalapp/logout.php">Logout</a>
    </li>';
}

echo '
    </ul>
  </div>
</div>
</nav>';
?>
    <div class="bg">
        <div class="bg-img">
            <img class="background-image" src="./Img/Aboutbg.png" alt="About Background"/>
            <div class="overlay-text">About</div>
            <div class="overlay-texts">us</div>
        </div>
        <br class="bg">
        <section class="about-text bg container">
            <h3 class="UC">About this Journal</h3>
            <p>Welcome to our personal journal app! We're thrilled to have you here.</p>
            <h4 class="UC">Our Mission</h4>
            <p>
                At Personal Journaling, our mission is to provide a safe, secure, and private space for you to express yourself,
                reflect on your thoughts and emotions, and document your life journey. We understand the importance of having a 
                personal space where you can freely express your thoughts, feelings, and experiences without any judgment.
            </p>
            <h4 class="UC">What we offer</h4>
            <p><strong>Secure and Private:</strong> Your privacy and security are our top priorities. Our app is designed with advanced encryption and security measures to ensure that your journal entries remain private and confidential. You can trust us to keep your personal information safe.</p>
            <p><strong>User-friendly Interface:</strong> We've created an intuitive and user-friendly interface that makes it easy for you to write, edit, and organize your journal entries. Whether you're writing a quick note or a detailed reflection, our app makes the process seamless and enjoyable.</p>
            <h4 class="UC">Get in Touch</h4>
            <p>
                We'd love to hear from you! If you have any questions, feedback, or suggestions, please don't hesitate to reach out to us. You can contact us via email at <a href="mailto:kunalwadile12@gmail.com">kunalwadile12@gmail.com</a> or connect with us on social media <a href="https://www.instagram.com/_kunal.wadile_?igsh=d2dxanRmdWI2am8z">Instagram</a>.<br />
                Thank you for choosing Personal Journaling as your personal journaling companion. We hope our app helps you on your journey of self-discovery and personal growth.
                <br />
                <p class="end">Happy journaling!</p>
            </p>
        </section>
        <br class="bg">
    </div>
</body>
</html>
