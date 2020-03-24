<?php
    /*
    CLIENT'S INTERFACE
    TO-DO
    - Display all the tickets that the client has
    - When client clicks on the ticket id it should redirect to show ticket page where there is a chatting interface
    - Page should have New ticket link which will allow the user to make new ticket
    */
    session_start();
    //fetching user id of logged in user
    $userid = $_SESSION['userid'];
    $userTickets = [];
    //loading tickets.xml file
    $tickets = simplexml_load_file("xml/tickets.xml"); 
    //fetching tickets of a particular client
    for($i = 0; $i<sizeof($tickets); $i++){
        if($tickets->ticket[$i]['userid'] == $userid){
            array_push($userTickets,$tickets->ticket[$i]);
        }
    }
?>
<html>
    <head>
        <title>client tickets</title>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <main>
            <h1>Submitted tickets</h1>
            <div><a href="newTicket.php">New ticket</a></div>
            <div class="list-container">
                <div class="list-row">
                    <div class="column-heading row-items">S No.</div>
                    <div class="column-heading row-items">Ticket date</div>
                    <div class="column-heading row-items">Ticket Subject</div>
                    <div class="column-heading row-items">Ticket Status</div>
                </div>
                
                <?php
                //displaying list of submitted tickets
                    for($i=0; $i<sizeof($userTickets); $i++){
                        echo('<div class="list-row">
                                <div class="list-data row-items">'.($i+1).'</div>
                                <div class="list-data row-items">'.$userTickets[$i]['ts'].'</div>
                                <div class="list-data row-items"><a href="showTicket.php?id='.$userTickets[$i]['id'].'">'.$userTickets[$i]->subject.'</a></div>
                                <div class="list-data row-items">'.$userTickets[$i]->status.'</div>
                            </div>');
                    }
                ?>
            </div>
        </main>
    </body>
</html>