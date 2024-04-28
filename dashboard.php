<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">


    <style>
    .active-link{
    background: #fff;
    padding-top: 1rem ;
    padding-bottom: 1rem;

    
    border-radius: 30px 0px 0px 30px;
    color: #2b0a0a !important;
    }
    </style>


</head>
<body>
<div class="sidebar">
        <div class="sidebar-brand">
            <h1>  Kids Quiz</h1>
        </div>

        <div class="sidebar-menu">
            <ul>


                <!-- <li>
                    <a href="index.php"> <span class="las la-igloo"></span>Dashboard<span></span> </a>
                </li> -->

                <li>
                    <a href="newquestion_form.php"> <span class="las la-users"></span>Add something New Questions<span></span> </a>
                </li>

                <li>
                    <a href="existingquestion.php"> <span class="las la-list"></span>Existing Questions<span></span> </a>
                </li>

                

                
            </ul>

        </div>

    </div>
    <script>
         // Get the current page URL
         var currentUrl = window.location.href;

         // Get all the navigation links
        var sidebarLinks = document.querySelectorAll('.sidebar a');

        // Loop through each navigation link
        sidebarLinks.forEach(function(link) {
            // Check if the link's href matches the current page URL
            if (link.href === currentUrl) {
                // Add the active class to the link
                link.classList.add('active-link');
            }
        });
    </script>
</body>
</html>