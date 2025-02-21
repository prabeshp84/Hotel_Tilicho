<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tilicho</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>
    <!--Header-->
    <div id="header-container"></div>

    <!--Top-PART-->
    <section class="top">
        <div id="toppart"></div>
        <div class="sec1">
            <h1>Welcome to The Hotel Tilicho</h1>
            <br/>
            <p>Come & Experience the outdoors an Iconic Hideway in the Lap of Nature's Gift</p>
            <a href="services.html">Know more about our services</a>
        </div>
    </section>
    
    <!-- Profile Management Section -->
    <section class="profile-management">
        <h1>Profile Management</h1>
        <div class="profile-details">
            <h2>Your Profile</h2>
            <p><strong>Username:</strong> <span id="profile-username"><?php echo htmlspecialchars($user['username']); ?></span></p>
            <p><strong>Email:</strong> <span id="profile-email"><?php echo htmlspecialchars($user['email']); ?></span></p>
            <button id="edit-profile-button">Edit Profile</button>
        </div>
        
        <div id="edit-profile-form" style="display: none;">
            <h2>Edit Profile</h2>
            <form id="profile-form">
                <label for="new-email">New Email:</label>
                <input type="email" id="new-email" name="new-email" placeholder="Enter new email">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password" placeholder="Enter new password">
                <button type="submit">Update Profile</button>
            </form>
            <button id="cancel-edit-button">Cancel</button>
        </div>
    </section>
    
    <!--SEC-2-->
    <div class="sec2">
        <img src="images/pic1.jpg" alt="resort" class="pic1" />
        <img src="images/pic2.jpg" alt="resort" class="pic2" />
        <div class="writing">
            <h1>Beauty Of the Nature</h1>
            <p>This is not an escape from everyday life. It is the return to a life well lived. Where rugged luxury meets unregulated freedom...</p>
            <a href="About.html">Our Story</a>
        </div>
    </div>

    <!--SEC-3-->
    <div class="sec3top">
        <h1>What's New?</h1>
        <div class="sec3">
            <h1>ANNOUNCING OUR 2024-2025 SEASON OPENING DATES</h1>
            <p>Like birdsong and budding trees, our seasonal reopening is a certain sign of spring...</p>
        </div>
    </div>
    
    <!--SEC-4-->
    <div class="sec4">
        <h1>Secret Villa</h1>
        <p>Welcome to The Secret Beach Villa, a stunning beachfront hideaway with 4 ensuite bedrooms for families and kids.</p>
        <a href="secret.html">Know More</a>
    </div>

    <!--Suggestion-->
    <div class="mail">
        <h1>Place For Suggestion</h1>
        <form action="#">
            <input type="email" placeholder="Enter Your Mail" />
            <br />
            <label> Enter your message for us:</label><br />
            <textarea name="message" rows="5" cols="60"></textarea>
            <br />
            <input class="sub" type="submit" value="Submit Your Response" />
        </form>
    </div>

    <!--Contact-->
    <div class="contact" id="contactus">
        <img src="images/Hotel Tilichopng.png" alt="the Hotel Tilicho" />
        <h3>Chandragiri-09, Kathmandu, Nepal</h3>
        <h3><br />+977-9840110141</h3>
        <h3><br />+977-9824961275</h3>
        <h3><br />+977-9834882966</h3>
        <h3><br />01-5522567</h3>
        <br />
        <h3>Email: HotelTilicho@gmail.com</h3>
    </div>

    <!--Footer-->
    <footer>
        <p>&copy; 2024 HOTEL TILICHO. All rights reserved.</p>
    </footer>

    <!-- JavaScript to load header.html and handle profile management -->
    <script>
        $(document).ready(function() {
            $("#toppart").load("header.html", function(response, status, xhr) {
                if (status == "error") {
                    console.log("Error: " + xhr.status + " " + xhr.statusText);
                } else {
                    console.log("Header loaded successfully.");
                }
            });

            $("#edit-profile-button").on('click', function() {
                $("#edit-profile-form").show();
                $(this).hide();
            });

            $("#cancel-edit-button").on('click', function() {
                $("#edit-profile-form").hide();
                $("#edit-profile-button").show();
            });

            $("#profile-form").on('submit', function(e) {
                e.preventDefault();

                const formData = {
                    newEmail: $("#new-email").val(),
                    newPassword: $("#new-password").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "update_profile.php",
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            $("#profile-username").text(response.username);
                            $("#profile-email").text(response.email);
                            alert('Profile updated successfully');
                        } else {
                            alert('Error updating profile: ' + response.message);
                        }
                        $("#edit-profile-form").hide();
                        $("#edit-profile-button").show();
                    },
                    error: function() {
                        alert('Failed to update profile');
                    }
                });
            });
        });
    </script>
</body>
</html>
