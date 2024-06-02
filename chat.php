<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        

.chat-container {
  background: #fff;
  
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 400px;
  max-width: 100%;
}


.chat-header {
  background: white;
  color: #fff;
  padding: 15px;

}

.chat-header h2 {
  margin: 0;
}

.chat-messages {
  padding: 15px;
  height: 300px;
  overflow-y: scroll;
  border-bottom: 1px solid #f4f4f4;
}


.chat-messages::-webkit-scrollbar {
  width: 10px; 
}


.chat-messages::-webkit-scrollbar-track {
  background: #f1f1f1; 
}


.chat-messages::-webkit-scrollbar-thumb {
  background: #888; 
  border-radius: 5px; 
}


.chat-messages::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

.message {
  display: inline-block;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 10px;
  background: greenyellow;
  word-wrap: break-word; 
  min-width: 100px; 
  max-width: 100%;
  clear: both;
}

.message1 {
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 10px;
  background: #168AFF;
  /* display: flex; */
  /* justify-content: flex-end; */
  float: right;
}

/* .m {
  width: 100%;
  border: 1px solid black;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 10px;
  background: #168AFF;
} */

.sender {
  font-weight: bold;
}

.chat-input {
  display: flex;
  padding: 15px;
}

.chat-input input {
  flex: 1;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin-right: 10px;
}

.chat-input button {
  padding: 10px 15px;
  border: none;
  background: #007bff;
  color: #fff;
  border-radius: 5px;
  cursor: pointer;
}

.chat-input button:hover {
  background: #0056b3;
}

    </style>
</head>
<body>
  <div class="chat-container">
    <div class="chat-header">
    
      <h2><a href="index1.php"><i class="fa fa-arrow-left" aria-hidden="true" style="color: white;"></i></a><span id="receiver-username-display" class="ms-2"></span></h2>
    </div>
    <div class="chat-messages" id="chat-messages">
      <!-- Messages will be appended here -->
    </div>
    <div class="chat-input">
      <input type="text" id="message-input" placeholder="Type your message...">
      <button id="send-button">Send</button>
    </div>
  </div>

  <script>
    // Function to extract the username parameter from the URL
    function getParameterByName(name) {
      name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
      var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
          results = regex.exec(location.search);
      return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    // function displayMessages(messages) {
    //   var chatMessages = $('#chat-messages');
    //   chatMessages.empty(); // Clear existing messages
    //   messages.forEach(function(message) {
    //     var messageElement = '<div class="message"><span class="sender">' + message.sender_username + ':</span> ' + message.message + '</div>';
    //         $('#chat-messages').append(messageElement);
    //   });
    // }

    // function fetchMessages() {
    //   var receiverUsername = getParameterByName('username');

    //   $.ajax({
    //     url: 'fetch_messages.php',
    //     type: 'GET',
    //     data: {
    //       receiver: receiverUsername
    //     },
    //     success: function(response) {
    //       var messages = JSON.parse(response);
    //       $('#chat-messages').empty(); // Clear existing messages

    //       displayMessages(messages);
    //     },
    //     error: function(error) {
    //       console.error("Error fetching messages: ", error);
    //     }
    //   });
    // }


    function fetchMessages() {
      // Send a long polling request to fetch messages
      $.ajax({
        url: 'fetch_messages.php',
        type: 'GET',
        success: function(messages) {
          displayMessages(messages);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching messages:', error);
        }
      });
    }

    function displayMessages(messages) {
      var chatMessages = $('#chat-messages');
      var receiverUsername = getParameterByName('username');
      chatMessages.empty(); // Clear existing messages
      messages.forEach(function(message) {
        var sessionUser = "<?php echo $_SESSION['user']; ?>";
        if(message.sender_username === sessionUser && message.receiver_username === receiverUsername){
            var messageElement = '<div class="message1">' + message.message + '</div><br><br><br>';
    }else if(message.sender_username === receiverUsername && message.receiver_username === sessionUser) {
        
        var messageElement = '<div class="message"><span class="sender">' + message.sender_username + ':</span> ' + message.message + '</div><br>';
    }
        chatMessages.append(messageElement);
      });
    }



    function sendMessage(receiverUsername, message) {
      $.ajax({
        url: 'store_message.php',
        type: 'POST',
        data: {
          receiver: receiverUsername,
          message: message
        },
        success: function(response) {
          var result = JSON.parse(response);
          if (result.status === 'success') {
            var messageElement = '<div class="message1"> ' + message + '</div>';
            $('#chat-messages').append(messageElement);
            $('#message-input').val(''); // Clear the input field
          } else {
            console.error("Failed to send message.");
          }
        },
        error: function(error) {
          console.error("Error sending message: ", error);
        }
      });
    }

    $(document).ready(function() {
      // Extract the receiver's username from the URL
      var receiverUsername = getParameterByName('username');
      console.log("Receiver Username from URL: " + receiverUsername); // Debugging to check the extracted username

      if (receiverUsername) {
        // Display the receiver's username
        $('#receiver-username-display').text(receiverUsername);
      } else {
        console.error("Receiver username not found in the URL.");
      }

      // Fetch and display messages from the database
      fetchMessages();
      setInterval(fetchMessages, 5000);
      // Sending a message
      $('#send-button').click(function() {
        var message = $('#message-input').val();
        if (message.trim() !== "") {
          sendMessage(receiverUsername, message);
        }
        
      });
    });
  </script>
</body>
</html>
