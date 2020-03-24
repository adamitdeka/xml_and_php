<?php
    session_start();
    //fetching user id of logged in user
    $userid = $_SESSION['userid'];
    //loading tickets.xml file
    $tickets = simplexml_load_file('xml/tickets.xml');
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
            <div class="ticket-data-container">
                <div class="ticket-data">User Id: <?=$ticketUserId?></div>
                <div class="ticket-data">Status:
                    <form>
                        <select class="status-dropdown">
                            <option value="ongoing" 
                                <?php
                                    if($ticketStatus == "ongoing"){
                                        echo('selected');
                                    }
                                    else{
                                        echo('');
                                    }
                                ?>>
                                ongoing
                            </option>
                            <option value="resolved" 
                                <?php
                                    if($ticketStatus == "resolved"){
                                        echo('selected');
                                    }
                                    else{
                                        echo('');
                                    }
                                ?>>
                                resolved
                            </option>
                        </select>
                        <input type="submit" value="Update" name="ticket-submit" class="submit-button">
                        <div class="ticket-data">
                            Last updated: <?=$statusLu?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="chatbox">
                <div id="chatbox-heading">
                    <h2>Chatbox</h2>
                </div>
                <div class="chat-container">
                    <?php
                        foreach($ticketMsgs as $ticketMsg){
                            //display the messages
                        }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>