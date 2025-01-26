<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 p-4">
        <h3 class="h-font fw-bold fs-3 mb-2">HAPPY HOME</h3>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Voluptas sequi quam quae molestiae, sunt impedit at rerum
            eius aliquid! Quia eaque aliquid, aperiam suscipit cumque 
            alias quod magni voluptate inventore?
        </p>
        </div>
        <div class="col-lg-4 p-4">
        <h5 class="mb-3">Links</h5>
        <a href="#" class="d-incline-block mb-2 text-dark text-decoration-none">Home</a> <br>
        <a href="#" class="d-incline-block mb-2 text-dark text-decoration-none">Rooms</a> <br>
        <a href="#" class="d-incline-block mb-2 text-dark text-decoration-none">Facilities</a> <br>
        <a href="#" class="d-incline-block mb-2 text-dark text-decoration-none">Contact Us</a> <br>
        <a href="#" class="d-incline-block mb-2 text-dark text-decoration-none">About Us</a>
        </div>
        <div class="col-lg-4 pg-4 ">
        <h5 class="mb-3">Follow Us</h5>
        <a href="#" class= "d-inline-block text-dark text-decoration-none mb-2">
            <i class="bi bi-twitter-x"></i> Twitter-x
        </a> <br>
        <a href="#" class= "d-inline-block text-dark text-decoration-none mb-2">
            <i class="bi bi-facebook"></i> Facebook
        </a> <br>
        <a href="#" class= "d-inline-block text-dark text-decoration-none">
            <i class="bi bi-instagram"></i> Instagram
        </a> <br>
        </div>
    </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">LOVESH GURUNG</h6>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
 



    let register_form = document.getElementbyId('register-form');
    register_form.addEventListner('submit',function(e)=>{
        e.preventDefault();

        let data = new FormData();

        data.append('name',register_form.elements['name'].value);
        data.append('email',register_form.elements['email'].value);
        data.append('phonenum',register_form.elements['phonenum'].value);
        data.append('address',register_form.elements['address'].value);
        data.append('postalcode',register_form.elements['postalcode'].value);
        data.append('dob',register_form.elements['dob'].value);
        data.append('pass',register_form.elements['pass'].value);
        data.append('cpass',register_form.elements['cpass'].value);
        data.append('profile',register_form.elements['profile'].files[0]);
        data.append('register','')


        var myModal = document.getElementbyId('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/login_register.php",true);

        xhr.onload = function(){

        }
        xhr.send(data);


    })

</script>
