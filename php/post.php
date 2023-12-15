<?php
    header('Content-type: application/json');
    header('Access-Control-Allow-Headers: Content-Type');
    header("Access-Control-Allow-Origin: *");
    
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    // Make sure each field contains a value in order to avoid mailing issues
    $appell = " ";
    $firm = " ";
    $lastName = " ";
    $firstName = " ";
    $street = " ";
    $zip = " ";
    $location = " ";
    $email = " ";
    $tel = " ";
    $subject = "Nachricht aus dem Kontaktformular von Zimpuservice: ";
    $message = " ";

    $appell .= $input['appell'];
    $firm .= $input['firm'];
    $lastName .= $input['lastName'];
    $firstName .= $input['firstName'];
    $street .= $input['street'];
    $zip .= $input['zip'];
    $location .= $input['location'];
    $email .= $input['email'];
    $tel .= $input['tel'];
    $subject .= $input['subject'];
    $message .= $input['message'];
    $to = "peter.zimmermann@zimpuservice.ch";
    $headers = 'From: peter.zimmermann@zimpuservice.ch' . "\r\n" .
    "Reply-To: $email" . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $result['error'] = false;
    $result['success'] = false;   
    
    $body = "NACHRICHT AUS DEM KONTAKTFORMULAR\n Anrede: $appell\n Firma: $firm\n Name: $lastName\n Vorname: $firstName\n Strasse: $street\n PLZ: $zip\n Ort: $location\n E-Mail: $email\n Tel: $tel\n Mitteilung: $message";
    if (mail($to, $subject, $body, $headers, "Mime-Version: 1.0 Content-Type: text/plain; charset=UTF-8 Content-Transfer-Encoding: 8bit")) {
        $result['success'] = true;
    } else { 
        $result['error'] = true;
    }
    
    echo json_encode($result);
?>
