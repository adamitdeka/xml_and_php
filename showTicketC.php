<?php
    session_start();
    //fetching user id of logged in user
    $userid = $_SESSION['userid'];
    //loading tickets.xml file
    $tickets = simplexml_load_file('xml/tickets.xml');
   
    //loading users.xml file to fetch username
    $users = simplexml_load_file('xml/users.xml');
    //fetching ticketid from url
    $ticketId = $_GET['id'];
    $userTickets = [];
    //fetching tickets of a particular client
    for($i = 0; $i<sizeof($tickets); $i++){
        if($tickets->ticket[$i]['id'] == $ticketId){
           $ticketUserId = $tickets->ticket[$i]['userid'];
           $ticketSubject = $tickets->ticket[$i]->subject; 
           $ticketStatus = $tickets->ticket[$i]->status;
           $statusLu = $tickets->ticket[$i]->status['sdate']; 
           $ticketMsgs = $tickets->ticket[$i]->message;
        }
    }

    //sending message
    if(isset($_POST['msg-send'])){
        if($_POST['msg-text'] != "" || $_POST['msg-text'] != null){
            $msgText = $_POST['msg-text'];
            //adding message element
            $message = $tickets->ticket[$ticketId-1]->addChild('message', $msgText);
            //attr of message element
            $message->addAttribute('sentby', $userid);
            $tickets->saveXML('xml/tickets.xml');
        }
    }
?>

<html>
    <head>
        <title>Show ticket</title>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <main>
            <h1>Subject: <?=$ticketSubject?></h1>
            <a href="client.php">Home</a>
            <a href="index.php">Logout</a>
            <div class="ticket-data-container">
                <div class="ticket-data">User Id: <?=$ticketUserId?></div>
                <div class="ticket-data">Status: <?=$ticketStatus?></div>
            </div>
            <div class="chatbox">
                <div id="chatbox-heading">
                    <h2>Chatbox</h2>
                </div>
                <div class="chat-container">
                    <?php
                        foreach($ticketMsgs as $ticketMsg){
                            //display the messages
                            if($ticketMsg['sentby']==$userid){
                                echo('
                                <div class="msg-container fromMsg">
                                    <div class="user-tn">You:</div>
                                    <div class="msg">'.$ticketMsg.'</div>
                                </div>
                            ');
                            }
                            else{
                                echo('
                                <div class="msg-container toMsg">
                                    <div class="user-tn">User: '.$ticketMsg['sentby'].'</div>
                                    <div class="msg">'.$ticketMsg.'</div>
                                </div>
                            '); 
                            }
                            
                        }
                    ?>
                </div>
                <form method="post" class="msg-box">
                    <input type="text" class="chat-input" name="msg-text" placeholder="Enter your message here">
                    <input type="submit" name="msg-send" class="submit-button" value="send">
                </form>
            </div>
        </main>
    </body>
</html>