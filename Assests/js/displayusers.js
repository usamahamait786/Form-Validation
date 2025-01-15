var table = $("#userTable").DataTable(); // Initialize DataTable

$("#displayUserData").on("click", function () {
  // Make AJAX request to get user data
  let data = {
    action: "fetchusers",
  };
  $.ajax({
    url: "action.php", // PHP file that fetches the user data
    type: "POST",
    data: data,
    success: function (response) {
      var data = JSON.parse(response);
      if (data.status === "success") {
        // Clear the existing table data
        table.clear();

        // Loop through each user and add data to the table
        data.usersrecord.forEach(function (user) {
          table.row
            .add([
              user.id,
              user.username,
              user.email,
              user.phone,
              user.subjects,
              user.city,
              "<img src='" +
                user.profile +
                "' alt='Profile Image' width='100'>",
              `<div class="button-container">
                         <button type="button" class="btn btn-primary update-btn" data-id="${user.id}"  >Update</button>
                         <button class="delete-btn" data-id="${user.id}">Delete</button>
                          </div>`,
            ])
            .draw();
        });
      } else {
        alert("Error: " + data.message);
      }
    },
    error: function () {
      alert("Something went wrong. Please try again later.");
    },
  });
});

// Delete user
$("#userTable").on("click", ".delete-btn", function () {
  var editBtn = $(this);
  var userId = $(this).data("id");
  // Confirm before deletion
  if (confirm("Are you sure you want to delete this user?")) {
    let data = {
      action: "deleteusers",
      userId: userId,
    };
    // Make AJAX request to delete the user
    $.ajax({
      url: "action.php", // PHP file that deletes the user
      type: "POST",
      data: data,
      success: function (response) {
        var data = JSON.parse(response);

        if (data.status === "success") {
          // If the deletion was successful, remove the row from the table
          table.row(editBtn.parents("tr")).remove().draw();
        } else {
          // If there was an error, show an alert
          alert("Error: " + data.message);
        }
      },
      error: function () {
        // If something went wrong with the request, show an alert
        alert("Something went wrong. Please try again later.");
      },
    });
  }
});

// Fetch user data and show modal
$("#userTable").on("click", ".update-btn", function () {
  var userId = $(this).data("id");

  if (!userId) {
    alert("User ID is missing.");
    return;
  }
  let data = {
    action: "getuser",
    userId: userId,
  };

  // Fetch user data from server
  $.ajax({
    url: "action.php",
    type: "POST",
    data: data,
    success: function (response) {
      console.log(response);

      var data = JSON.parse(response);
      if (data.status === "success") {
        // Fill the form with user data
        $("#updateUsername").val(data.user.username);
        $("#updateEmail").val(data.user.email);
        $("#updatePhone").val(data.user.phone);
        $("#updateSubjects").val(data.user.subjects);
        $("#updateCity").val(data.user.city);
        $("#updateUserId").val(data.user.id); // Set user ID in hidden field
        $("#updateProfile").val(data.user.Profile);
        // Show the modal
        $("#updateModal").addClass("show");
      } else {
        alert("Failed to load user data.");
      }
    },
    error: function () {
      alert("Error fetching user data.");
    },
  });
});

// Close the modal when the user clicks the close button
$("#closeModal").on("click", function () {
  $("#updateModal").removeClass("show"); // Hide the modal
//   $("#updateProfilePreview").hide();
});

// Close the modal if the user clicks outside the modal content
// $('#updateModal').on('click', function(event) {
//     if ($(event.target).is('#updateModal')) {
//         $('#updateModal').removeClass('show'); // Hide the modal
//     }
// });

// Handle form submission (update user)
$("#updateForm").on("submit", function (event) {
  event.preventDefault(); // Prevent default form submission

  var formData = new FormData(this); // Create FormData object for handling file uploads
  formData.append("action", "updateuser");
  $.ajax({
    url: "action.php", // PHP file that handles the update
    type: "POST",
    data: formData,
    processData: false, // Important for file upload
    contentType: false, // Important for file upload
    success: function (response) {
      var data = JSON.parse(response);
      if (data.status === "success") {
        $("#updateModal").removeClass("show"); // Close the modal
        // $("#updateProfilePreview").hide();
        $("#displayUserData").click(); // Refresh the user table
      } else {
        alert("Error: " + data.message);
      }
    },
    error: function () {
      alert("Something went wrong. Please try again.");
    },
  });
});
// $("#updateProfile").on("change", function () {
//   var file = this.files[0];
//   var reader = new FileReader();
//   reader.onload = function (e) {
//     $("#updateProfilePreview").show();
//     $("#updateProfilePreview").attr("src", e.target.result);
//   };
//   reader.readAsDataURL(file);
// });

// Search functionality
function searchTable() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("userTable");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    // Start from 1 to skip the header row
    tr[i].style.display = "none"; // Hide the row initially
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break; // Show the row and break the loop if a match is found
        }
      }
    }
  }
}
