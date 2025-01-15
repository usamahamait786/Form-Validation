<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Assests/css/validation.css">
</head>

<body>

    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-2">Sign up</p>

                                    <form method="POST" action="action.php" id="form1" enctype="multipart/form-data"
                                        class="mx-1 mx-md-4">
                                        <div id="response-message"
                                            class="d-flex flex-row align-items-center mb-2 alert registrationAlert">
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Your Name</label>
                                                <input type="text" name="username" id="username" class="form-control" />
                                                <div id="nameerror" class="error">Name is Required</div>

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                                <input type="email" name="useremail" id="useremail"
                                                    class="form-control" />
                                                <div class="error" id="emailerror">Email is Required with Proper Format
                                                </div>
                                                <div class="error" id="emailerror1"></div>

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Phone No</label>
                                                <input type="tel" name="userphone" id="userphone"
                                                    placeholder="0000-0000000" minlength="12" maxlength="12"
                                                    class="form-control" />
                                                <div class="error" id="phoneerror">Phone No is Required with Correct
                                                    Format </div>
                                                <div class="error" id="phoneerror1"> </div>

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-2 mt-2">
                                                <button class="add_button" name="add_button" id="add_button">Add City
                                                    Name</button>
                                                <p id="cityerror">Please Add Your City Name</p>
                                                <div id="inputFields"></div>

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mt-2">
                                                <label for="subjects">Choose a Subject</label>
                                                <select name="subjects" id="subjects" onchange="showAlert()">
                                                    <option value="Choose">Choose</option>
                                                    <option value="Medical">Medical</option>
                                                    <option value="Engineering">Engineering</option>

                                                </select>
                                                <p id="selecterror">Please Choose Medical/Engineering</p>

                                            </div>
                                        </div>


                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">

                                                <input type="checkbox" id="chemistry" name="chemistry" value="Bike">
                                                <label for="chemistry">Chemistry</label><br>
                                                <input type="checkbox" id="biology" name="biology" value="Car">
                                                <label for="biology">Biology</label><br>
                                                <input type="checkbox" id="english" name="english" value="Bost">
                                                <label for="english">English</label><br>
                                                <input type="checkbox" id="physics" name="physics" value="Boat">
                                                <label for="physics"> Physics</label><br>
                                                <input type="checkbox" id="math" name="math" value="Bot">
                                                <label for="math"> Mathematics</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input type="password" name="userpassword" id="userpassword"
                                                    class="form-control" />
                                                <div class="error" id="userpassworderror">Passwor must be atleast 6
                                                    character include 1
                                                    uppercase, lowercase, number and Special Character.</div>

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">

                                                <ul>
                                                    <li id="lowercase" class="invalid">Lowercase Letter: <span
                                                            id="lowercase-status">Not
                                                            Done</span></li>
                                                    <li id="uppercase" class="invalid">Uppercase Letter: <span
                                                            id="uppercase-status">Not
                                                            Done</span></li>
                                                    <li id="number" class="invalid">Number: <span id="number-status">Not
                                                            Done</span></li>
                                                    <li id="special" class="invalid">Special Character: <span
                                                            id="special-status">Not Done</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Confirm your
                                                    password</label>
                                                <input type="password" id="userconpassword" class="form-control" />
                                                <div id="matcherror">Password not Match. </div>

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Upload Your
                                                    Image</label>
                                                <input type="file" name="profileimage" id="profileimage"
                                                    accept=".jpg, .jpeg, .png, .gif, .webp, .ico,  .heic, .heif"
                                                    class="form-control" />
                                                <div id="imageerror">Please Upload Your Image. </div>

                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4  mb-lg-4">
                                            <button type="submit" id="submit-btn" data-mdb-button-init
                                                data-mdb-ripple-init class="btn btn-primary btn-lg">Register</button>
                                        </div>

                                    </form>


                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="/form validation/Assests/images/draw1.png" class="img-fluid"
                                        alt="Form image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>
<script src="Assests/js/validation.js"></script>

</html>