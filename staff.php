<?php
    /*
    Staff'S INTERFACE
    TO-DO
    - Display all the tickets 
    - When staff clicks on the ticket id it should redirect to show ticket page where there is a chatting interface
    */
    session_start();
    //fetching user id of logged in user
    $userid = $_SESSION['userid'];
    //loading tickets.xml file
    $tickets = simplexml_load_file("xml/tickets.xml");
?>
<html>
    <head>
        <title>List of tickets</title>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <main>
            <h1>List of tickets</h1>
            <div><a href="newTicket.php">New ticket</a></div>
            <div class="list-container">
                <div class="list-row">
                    <div class="column-heading row-items">S No.</div>
                    <div class="column-heading row-items">Ticket Subject</div>
                    <div class="column-heading row-items">User Id</div>
                    <div class="column-heading row-items">Ticket date</div>
                    <div class="column-heading row-items">Ticket Status</div>
                </div>
                
                <?php
                //displaying list of submitted tickets
                    for($i=0; $i<sizeof($tickets); $i++){
                        echo('<div class="list-row">
                                <div class="list-data row-items">'.$tickets->ticket[$i]['id'].'</div>
                                <div class="list-data row-items"><a href="showTicket.php?id='.$tickets->ticket[$i]['id'].'">'.$tickets->ticket[$i]->subject.'</a></div>
                                <div class="list-data row-items">'.$tickets->ticket[$i]['userid'].'</div>
                                <div class="list-data row-items">'.$tickets->ticket[$i]['ts'].'</div>
                                <div class="list-data row-items">'.$tickets->ticket[$i]->status.'</div>
                            </div>');
                    }
                ?>
            </div>
        </main>
    </body>
</html>

