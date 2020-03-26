<?php
    session_start();
    //fetching user id of logged in user
    $userid = $_SESSION['userid'];
    $ticketSubject = "";
    $ticketMessage = "";
    $errorMsg = "";
    if(isset($_POST['ticket-submit'])){
        $ticketSubject = $_POST['subject-field'];
        $ticketMessage = $_POST['msg-field'];
        if($ticketSubject != "" || $ticketSubject != null || $ticketMessage != "" || $ticketMessage != null){
            //loading tickets.xml file
            $tickets = simplexml_load_file("xml/tickets.xml");
            //adding ticket element
            $ticket = $tickets->addChild('ticket');
            //attr of ticket element
            $ticket->addAttribute('id', sizeof($tickets));
            $ticket->addAttribute('userid', $userid);
            $ticket->addAttribute('ts', date("Y-m-d\TH:i:s", time()));
            //adding status element
            $status = $ticket->addChild('status', 'ongoing');
            //attr of status element
            $status->addAttribute('sdate',date("Y-m-d",time()));
            //adding subject element
            $subject = $ticket->addChild('subject', $ticketSubject);
            //adding message element
            $message = $ticket->addChild('message', $ticketMessage);
            //attr of message element
            $message->addAttribute('sentby', $userid);
            $tickets->saveXML('xml/tickets.xml');
            header("Location: client.php"); 
        }
        else{
            $errorMsg = 'Subject or message field empty!';
        }
    }
?>
<html>
    <head>
        <title>Add ticket</title>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <main>
            <h1>New Ticket</h1>
            <a href="client.php">Home</a>
            <a href="index.php">Logout</a>
            <form method="post" class="add-form">
                <div class="form-field">
                    <label for="subject-field" class="field-label">Subject: </label>
                    <input id="subject-field" name="subject-field" class="text-field" type="text"/>
                </div>
                <div class="form-field">
                    <label for="msg-field" class="field-label">Message: </label>
                    <input id="msg-field" name="msg-field" class="text-field" type="text"/>
                </div>
                <input type="submit" value="Submit" name="ticket-submit" class="submit-button">
            </form>
            <div class="error_field">
                <?php
                    if($errorMsg){
                        echo ($errorMsg);
                    }
                ?>
            </div>
        </main>
    </body>
</html>