<?php
// send-mail.php

// 1. CONFIGURATION
$to_email = "justin.henriksen@gmail.com"; 
$from_email = "noreply@henriksenfamily.org"; // It is best to use an email from your own domain here

// 2. CHECK IF FORM WAS SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Initialize an empty message variable
    $email_content = "";
    
    // 3. DETECT WHICH FORM (GRANT VS CONTACT)
    // We check for a specific field unique to the grant form
    if (isset($_POST['fullName'])) {
        // --- GRANT APPLICATION ---
        $subject = "New Grant Application: " . strip_tags($_POST['fullName']);
        
        $email_content .= "Applicant Name: " . strip_tags($_POST['fullName']) . "\n";
        $email_content .= "Email: " . strip_tags($_POST['email']) . "\n";
        $email_content .= "Phone: " . strip_tags($_POST['phone']) . "\n";
        $email_content .= "Address: " . strip_tags($_POST['address']) . "\n\n";
        
        $email_content .= "Applying for: " . strip_tags($_POST['appType']) . "\n";
        if(!empty($_POST['recipientName'])) {
            $email_content .= "Recipient Name: " . strip_tags($_POST['recipientName']) . "\n";
            $email_content .= "Relationship: " . strip_tags($_POST['relationship']) . "\n";
        }
        
        $email_content .= "Support Type: " . strip_tags($_POST['supportType']) . "\n";
        $email_content .= "Amount Requested: " . strip_tags($_POST['amount']) . "\n\n";
        
        $email_content .= "--- PURPOSE & STORY ---\n";
        $email_content .= strip_tags($_POST['purpose']) . "\n\n";
        
        $email_content .= "--- TIMING ---\n";
        $email_content .= strip_tags($_POST['timing']) . "\n";

        // Set Reply-To to the applicant
        $reply_to = strip_tags($_POST['email']);

    } elseif (isset($_POST['contactName'])) {
        // --- CONTACT FORM ---
        $subject = "New Contact Inquiry from The Henriksen Family Giving Fund";
        
        $email_content .= "Name: " . strip_tags($_POST['contactName']) . "\n";
        $email_content .= "Email: " . strip_tags($_POST['contactEmail']) . "\n\n";
        $email_content .= "Message:\n" . strip_tags($_POST['contactMessage']) . "\n";

        // Set Reply-To to the contact person
        $reply_to = strip_tags($_POST['contactEmail']);
    } else {
        // Stop spam bots accessing the file directly
        header("Location: /index.html");
        exit;
    }

    // 4. SEND THE EMAIL
    $headers = "From: $from_email\r\n";
    $headers .= "Reply-To: $reply_to\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to_email, $subject, $email_content, $headers)) {
        // Success: Redirect to Thank You page
        header("Location: /thank-you.html");
        exit;
    } else {
        // Fallback if mail fails
        echo "There was a problem sending your email. Please try again.";
    }
}
?>