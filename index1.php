<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Portfolio.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color:#446981;
        }

        .search-container {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .search-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            flex: 1;
            font-size: 16px;
        }

        .username-container {
            background-color: rgba(0, 0, 0, 0.5);
            margin: 10px 0;
            padding: 10px;
            border-radius: 8px;
        }

        .username-container a {
            color: white;
            text-decoration: none;
        }

        .search {
            margin: auto;
            padding: 20px;
           
            border-radius: 20px;
        }

        .search-label {
            font-size: 35px;
            font-weight: 600;
            color: white;
        }
    </style>
</head>

<body>
 

    <!-- <h1>Search our website</h1> -->

    <div class="search">
        <div class="search-container">
            <input type="text" class="search-input" id="se" placeholder="Search...">
        </div>
        <div class="usernames" id="usernames"></div>
    </div>

    <script>
        $(document).ready(function() {
            var svalue = $("#se").val();
                console.log(svalue);

                $.ajax({
                        method: "POST",
                        url: "search.php",
                        data: {
                            seval: svalue
                        }
                    })
                    .done(function(m) {
                        var retObj = JSON.parse(m);
                        const usernames = retObj;
                        const usernamesDiv = document.getElementById('usernames');

                        // Clear previous search results
                        usernamesDiv.innerHTML = '';

                        usernames.forEach(user => {
                            const usernameContainer = document.createElement('div');
                            usernameContainer.classList.add('username-container');

                            const usernameLink = document.createElement('a');
                            usernameLink.classList.add('username-link');

                            usernameLink.textContent = user.name;
                            usernameLink.href = `chat.php?username=${encodeURIComponent(user.name)}`;

                            usernameContainer.appendChild(usernameLink);
                            usernamesDiv.appendChild(usernameContainer);
                        });

                    });
            function performSearch() {
                var svalue = $("#se").val();
                console.log(svalue);

                $.ajax({
                        method: "POST",
                        url: "search.php",
                        data: {
                            seval: svalue
                        }
                    })
                    .done(function(m) {
                        var retObj = JSON.parse(m);
                        const usernames = retObj;
                        const usernamesDiv = document.getElementById('usernames');

                        // Clear previous search results
                        usernamesDiv.innerHTML = '';

                        usernames.forEach(user => {
                            const usernameContainer = document.createElement('div');
                            usernameContainer.classList.add('username-container');

                            const usernameLink = document.createElement('a');
                            usernameLink.classList.add('username-link');

                            usernameLink.textContent = user.name;
                            usernameLink.href = `chat.php?username=${encodeURIComponent(user.name)}`;

                            usernameContainer.appendChild(usernameLink);
                            usernamesDiv.appendChild(usernameContainer);
                        });

                    });
            }

            // Attach input event listener to the search input
            $('#se').on('input', performSearch);
        });
    </script>
</body>

</html>