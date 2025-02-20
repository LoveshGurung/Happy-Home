<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Happy Home - CONTACT US</title>
  <?php require 'inc/links.php'; ?>
</head>

<body class="bg-light">
  <?php require ('inc/header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center"> CONTACT US</h2>
    <div class="bg-dark"></div>
    <p class="text-center mt-3">
      Lorem ipsum dolor sit amet consectetur, adipisicing elit.
      <br> Dolor magnam accusamus molestias cum quod rerum assumenda 
      facere aperiam reprehenderit obcaecati?
    </p>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-5 px-4">

        <div class="bg-white rounded shadow p-4" >
        <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3912.803020979376!2d83.9717269981872!3d28.261492874594442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995937fcb0643d1%3A0x1b63bf7043241499!2sLamachaur%2C%20Pokhara%2033700!5e0!3m2!1sen!2snp!4v1734019138478!5m2!1sen!2snp" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
        <h5>Address</h5>
        <a href="https://maps.app.goo.gl/H7vq4nQf6buSfCvA9" target="-blank" class="d-inline-block text-decoration-non text-dark mb-2">
          <i class="bi bi-geo-alt-fill"></i> Happy Homes, Lamchaur, Pokhara
        </a>

        <h5 class="mt-4">Call Us</h5>
          <a href="tel: 123456789" class= "d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> 123456789
          </a>
          <br>
          <a href="tel: 123456789" class= "d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> 123456789
          </a>

          <h5 class="mt-4">Email</h5>
          <a href="mailto: loveshgurung1@gmail.com" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-envelope-open-fill"></i> loveshgurung1@gmail.com
          </a>

          <h5 class="mt-4">Follow Us</h5>
          <a href="#" class= "d-inline-block mb-3 text-dark fs-6 me-2">
          <i class="bi bi-twitter-x"></i>
          </a>
          <a href="#" class= "d-inline-block mb-3 text-dark fs-6 me-2">
          <i class="bi bi-facebook"></i>
          </a>
          <a href="#" class= "d-inline-block mb-3 text-dark fs-6 me-2">
          <i class="bi bi-instagram"></i> 
          </a>
       </div>
      </div>
      <div class="col-lg-6 col-md-6 px-4">
        <div class="bg-white rounded shadow p-4">
          <form>
          <h5> Send a message</h5>
            <div class="mt-3">
                <label class="form-label" style="font-weight= 500;">Name</label>
                <input type="text" class="form-control shadow-none">
            </div>
            <div class="mt-3">
                <label class="form-label" style="font-weight= 500;">Email</label>
                <input type="email" class="form-control shadow-none">
            </div>
            <div class="mt-3">
                <label class="form-label" style="font-weight= 500;">Subject</label>
                <input type="text" class="form-control shadow-none">
            </div><div class="mt-3">
                <label class="form-label" style="font-weight= 500;">Message</label>
                <textarea class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
            </div>
            <button type="submit" class="btn text-white custom-bg mt-3">SEND</button>
          </form>    
       </div>
      </div>
    </div>
  </div>

  <?php require ('inc/footer.php')?>

</body>
</html>