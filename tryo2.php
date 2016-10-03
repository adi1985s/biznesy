<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="tryme#DBFFFF" />

	<title>Untitled 3</title>
</head>

<body>
<?php

//udate
// zmienic na serverze w pliku php.ini. ';' wyrzucic
    //$connection = imap_open('{poczta.o2.pl:993/ssl}Spam', 'abmforallego@o2.pl', 'pepesza12');
    $connection = imap_open('{poczta.o2.pl:993/imap/ssl}SPAM', 'abmforallego@o2.pl', 'pepesza12') 
    or die('Can\'t connect to the server'. imap_last_error());
    
    if ($connection){
        
        echo time(); // udate
        $mArray = imap_search($connection, 'ALL');
        //print_r($mArray);
        
        $msgBody = imap_fetchbody($connection, 1684, 1);
        echo htmlentities($msgBody). "<br />\n";
        echo $msgBody;
        
        
        $msgOverview = imap_fetch_overview($connection, 1684);
        print_r($msgOverview);
        $msgUdate = $msgOverview[0] -> udate;
        echo "$msgUdate <br />\n";
        $msgSubject = $msgOverview[0] -> subject;
        $msgSubject = quoted_printable_decode($msgSubject); // bez znaków ==20 itp
        
        echo "$msgSubject <br />\n";
        $payuPos = strpos($msgSubject, 'PayU');
        
        echo "$payuPos <br />\n";
        
        foreach (array_reverse($mArray) as $value){
            echo $value. "<br />\n";
        
        }
        
        
        #szukac po liœcie mArray i sprawdzaæ udate
        #szukaæ po payu tylko na miejscu 10
        
        // fetch_body i sprawdzac subject. Jak payu na jakims miejscu to ok
        // sprawdzac udate najpierw i do momentu az bedzie mniejsze to leciec po liscie i sprawdzac
        // funkcja sprawdzajaca udate teraz
        
        imap_close($connection);
        imap_errors(); // nieznane b³êdy IMAP4rev1
    }
        
    
?>    

</body>
</html>