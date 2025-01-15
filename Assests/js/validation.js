
let nameerror = $("#nameerror");
let emailerror = $("#emailerror");
let passworderror = $("#userpassworderror");
let matcherror = $("#matcherror");
let phoneerror = $("#phoneerror");
let selecterror = $("#selecterror");
let cityerror = $("#cityerror");
let imageerror = $("#imageerror");
let emailExistsError;
let phoneExistsError;

$('#submit-btn').on("click", function (event) {
  // Prevent form submission until validation is successful
  event.preventDefault();

  // Get form values
  let username = $("#username").val();
  let useremail = $("#useremail").val();
  let userphone = $("#userphone").val();
  let selectedOption = $("#subjects").val();
  let userpassword = $("#userpassword").val();
  let userconpassword = $("#userconpassword").val();
  let divEle = $("#inputFields").children("div");
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
  let profileimage = $("#profileimage").val();

  let isValid = true; // Flag to track form validity

  // Validate required fields
  if (username == "") {
    $("#nameerror").show();
    isValid = false;
  }
  if (useremail == "" || !emailRegex.test(useremail)) {
    $("#emailerror").show();
    isValid = false;
  }
  if (userphone == "" || userphone.length !== 12) {
    $("#phoneerror").show();
    isValid = false;
  }
  if (divEle.length === 0) {
    $("#cityerror").show();
    isValid = false;
  }
  if (selectedOption == "Choose") {
    $("#selecterror").show();
    isValid = false;
  }
  if (userpassword == "") {
    $("#userpassworderror").show();
    isValid = false;
  }
  if (userconpassword == "") {
    $("#matcherror").show();
    isValid = false;
  }

  // Validate password match and format
  if (userpassword && userconpassword && userpassword !== userconpassword) {
    $("#matcherror").show();
    isValid = false;
  }
  if (userpassword && !regularExpression.test(userpassword)) {
    $("#userpassworderror").show();
    isValid = false;
  }
  if (profileimage == "") {
    $("#imageerror").show();
    isValid = false;
  }

  if (isValid) {
    // Create a FormData object to send the form data
    let formData = new FormData($("#form1")[0]);
    let emailExistsError;
    let phoneExistsError;
    let lowercaseElement = $("#lowercase");
    let uppercaseElement = $("#uppercase");
    let numberElement = $("#number");
    let specialElement = $("#special");
    formData.append('action', 'submit');
  
    $.ajax({
      url: 'action.php',
      type: 'POST',
      data: formData, // Serialize the form data
      contentType: false,
      processData: false,
      success: function (response) {
        const res = JSON.parse(response); // Parse the response into a JavaScript object
  
        if (res.status === 'error') {
          let emailExistsError = res.errors.email; // Save server error for email
          let phoneExistsError = res.errors.phone; // Save server error for phone
  
          $("html, body").animate({
            scrollTop: $("#form1").offset().top
          }, "slow");
  
          if (emailExistsError) {
            $("#emailerror1").text(emailExistsError).show();
          } else {
            $("#emailerror1").hide();
          }
  
          if (phoneExistsError) {
            $("#phoneerror1").text(phoneExistsError).show();
          } else {
            $("#phoneerror1").hide();
          }
        } else if (res.status === 'success') {
          // Show success message
          $("#response-message")
            .removeClass("alert")
            .addClass("registrationAlert")
            .text(res.message)
            .fadeIn();
  
          $("html, body").animate({
            scrollTop: $("#form1").offset().top
          }, "slow");
  
          setTimeout(() => {
            $("#response-message").fadeOut(400, function () {
            
              $(this).text("");
              
            });
          }, 4000);
  
          // Reset form after success
          $("#form1")[0].reset();
          $("#inputFields").empty();
          lowercaseElement.removeClass("valid").addClass("invalid");
          uppercaseElement.removeClass("valid").addClass("invalid");
          numberElement.removeClass("valid").addClass("invalid");
          specialElement.removeClass("valid").addClass("invalid");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
      }
    });
  } else {
    // Scroll to the top of the form to show error messages
    $("html, body").animate({
      scrollTop: $("#form1").offset().top
    }, "slow");
  }
  
});


$('#username').on("input", function () {
  let username = $("#username").val();
  if (username == "") {
    $("#nameerror").show();
  } else {
    $("#nameerror").hide();
  }
});

$('#useremail').on("input", function () {
  let useremail = $("#useremail").val();
  if (useremail == "") {
    $("#emailerror").show();
  }else {
    $("#emailerror").hide();
  }
})
$('#useremail').on("input", function () {
  let useremail = $("#useremail").val();
  if (useremail == emailExistsError) {
    $("#emailerror1").show();
  }
  else if (useremail != "") {
    $("#emailerror1").hide();
  }
})

$('#userphone').on("input", function (event) {
  let userphone = $("#userphone").val();
  let input = event.target.value.replace(/\D/g, '');

  if (userphone == "") {
    $("#phoneerror").show();
  } else if (input.length === 10) {
    $("#phoneerror").hide();
  }

  else if (input.length > 4) {
    input = input.slice(0, 4) + '-' + input.slice(4);
    $("#phoneerror").hide();
  }

  else {
    $("#phoneerror").show();
  }

  event.target.value = input;
});
$('#userphone').on("input", function () {
  let userphone = $("#userphone").val();
  if (userphone == phoneExistsError) {
    $("#phoneerror1").show();
  }
  else if (userphone != "") {
    $("#phoneerror1").hide();
  }
})



$('#userpassword').on("input", function () {
  let userpassword = $("#userpassword").val();
  if (userpassword == "") {

    $('#userpassworderror').show();
  }
  else {
    $('#userpassworderror').hide();
  }
  const hasLowerCase = /[a-z]/.test(userpassword);
  const lowercaseElement = $("#lowercase");
  const lowercaseStatus = $("#lowercase-status");
  if (hasLowerCase) {
    lowercaseElement.removeClass("invalid").addClass("valid");
    lowercaseStatus.text("Done");
  } else {
    lowercaseElement.removeClass("valid").addClass("invalid");
    lowercaseStatus.text("Not Done");
  }

  // Check for uppercase letter
  const hasUpperCase = /[A-Z]/.test(userpassword);
  const uppercaseElement = $("#uppercase");
  const uppercaseStatus = $("#uppercase-status");
  if (hasUpperCase) {
    uppercaseElement.removeClass("invalid").addClass("valid");
    uppercaseStatus.text("Done");
  } else {
    uppercaseElement.removeClass("valid").addClass("invalid");
    uppercaseStatus.text("Not Done");
  }

  // Check for number
  const hasNumber = /\d/.test(userpassword);
  const numberElement = $("#number");
  const numberStatus = $("#number-status");
  if (hasNumber) {
    numberElement.removeClass("invalid").addClass("valid");
    numberStatus.text("Done");
  } else {
    numberElement.removeClass("valid").addClass("invalid");
    numberStatus.text("Not Done");
  }

  // Check for special character
  const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(userpassword);
  const specialElement = $("#special");
  const specialStatus = $("#special-status");
  if (hasSpecialChar) {
    specialElement.removeClass("invalid").addClass("valid");
    specialStatus.text("Done");
  } else {
    specialElement.removeClass("valid").addClass("invalid");
    specialStatus.text(" Not Done");
  }

})

$('#userconpassword').on('input', function () {
  let userconpassword = $('#userconpassword').val();
  if (userconpassword == "") {
    $("#matcherror").show();
  }
  else {
    $("#matcherror").hide();
  }
});
$('#profileimage').on('input', function () {
  let profileimage = $('#profileimage').val();
  if (profileimage == "") {
    $("#imageerror").show();
  }
  else {
    $("#imageerror").hide();
  }
});
$('#add_button').on("click", function (event) {
  event.preventDefault();
  cityerror.hide();
  // Create the new div, input field, and button
  let divEle = $("#inputFields"); // Get the main container div
  let createDiv = $("<div>"); // Create a div using jQuery
  let createInput = $("<input>", {
    type: "text",
    name: "city[]", // Ensure the 'name' is set to 'city[]'
    placeholder: "Enter Your City Name"
  });
  let createBtn = $("<button>", {
    text: "Delete",
    css: {
      marginTop: "5px",
      backgroundColor: "#ff1d8d",
      color: "white"
    }
  });
  // Append the input field and delete button to the createDiv
  createDiv.append(createInput, createBtn);
  // Append the createDiv to the main container div
  divEle.append(createDiv);
  // Event listener for the delete button
  createBtn.on("click", function (event) {
    event.preventDefault(); // Prevent default button behavior if inside a form
    let userConfirmed = confirm("Are you sure you want to delete this city name?");
    if (userConfirmed) {
      createBtn.text("Deleted"); // Change the text of the button
      createBtn.css({
        backgroundColor: "red", // Change button color to indicate deletion
        color: "white"
      });
      setTimeout(function () {
        createDiv.remove(); // Remove the specific div related to this button

      }, 2000); // Wait for 2 seconds before removing the div
    } else {
      alert("Delete action was canceled.");
    }
  });
});

function showAlert() {
  let selectedOption = $("#subjects").val();
  let selecterror = $("#selecterror").val();
  if (selectedOption == "Medical") {
    chemistry.disabled = true;
    biology.disabled = true;
  } else {
    biology.disabled = false;
    chemistry.disabled = false;
  }
  if (selectedOption == "Engineering") {
    math.disabled = true;
    physics.disabled = true;
  } else {
    math.disabled = false;
    physics.disabled = false;
  }
  if (selectedOption == "Choose") {
    $("#selecterror").show();
  }
  else {
    $("#selecterror").hide();
  }
};

