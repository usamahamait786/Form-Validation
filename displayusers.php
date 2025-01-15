
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="Assests/css/displayusers.css">
    <style>
        /* Hidden by default */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            justify-content: center;
            align-items: center;
        }

        /* Modal dialog style */
        .modal-dialog {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            max-width: 700px;
            width: 100%;
            margin-top: 150px;
        }

        /* Show the modal */
        .modal.show {
            display: flex;
        }
    </style>


</head>
</head>

<body>

    <div class="buttons-container">
        <!-- Button to fetch data -->
        <button id="displayUserData">Display All Users Data</button>
    </div>
    <div>
        
    <input type="text" placeholder="Search for Users...." id="searchInput" onkeyup="searchTable()">

    </div>

    <!-- Table to display user data -->
    <table id="userTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subjects</th>
                <th>Cities</th>
                <th>Profile</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <!-- Data will be inserted here dynamically -->
        </tbody>
    </table>





    <!-- Modal Structure -->
    <div id="updateModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update User Information</h5>
                    <button type="button" class="btn-close" aria-label="Close" id="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">

                        <div class="mb-3">
                            <label for="updateUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="updateUsername" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="updateEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="updateEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="updatePhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="updatePhone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateSubjects" class="form-label">Subjects</label>
                            <input type="text" class="form-control" id="updateSubjects" name="subjects" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="updateCity" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateProfile" class="form-label">Profile</label>
                            <input type="file" class="form-control" id="updateProfile" name="profile">

                        </div>

                        <!-- <div class="mb-3">

                            <img src="" id="updateProfilePreview" style="width: 100px; height: 100px; display:none;">
                        </div> -->

                        <input type="hidden" id="updateUserId" name="userId">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="Assests/js/displayusers.js"> </script>
    <script>
     
    </script>

</body>

</html>
