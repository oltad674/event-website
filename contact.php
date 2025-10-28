<?php
$pageTitle = "Contact Us";
include 'header.php';
?>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Contact Us</h1>
        <p>Get in touch with our team</p>
    </div>
</div>

<main class="container">
    <div class="contact-section" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin: 3rem 0;">
        <div class="contact-info">
            <div style="background-color: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <h2>Contact Information</h2>
                <p style="margin-top: 1rem;">We're here to help! Reach out to us using any of the methods below.</p>
                
                <div style="margin-top: 2rem;">
                    <h3>Email</h3>
                    <p><a href="mailto:info@eventhub.com">info@eventhub.com</a></p>
                </div>
                
                <div style="margin-top: 1.5rem;">
                    <h3>Phone</h3>
                    <p>+1 (555) 123-4567</p>
                </div>
                
                <div style="margin-top: 1.5rem;">
                    <h3>Address</h3>
                    <p>123 Event Street<br>City, State 12345<br>Country</p>
                </div>
                
                <div style="margin-top: 1.5rem;">
                    <h3>Hours of Operation</h3>
                    <p>Monday - Friday: 9:00 AM - 5:00 PM<br>Saturday - Sunday: Closed</p>
                </div>
            </div>
        </div>
        

    
    <div style="margin: 3rem 0;">
        <div style="background-color: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <h2>Frequently Asked Questions</h2>
            
            <div style="margin-top: 1.5rem;">
                <h3>How do I create an event?</h3>
                <p>To create an event, you need to register as an organizer. Once registered, log in to your account, go to your dashboard, and click on "Create Event" button.</p>
            </div>
            
            <div style="margin-top: 1.5rem;">
                <h3>Can I update my event after publishing it?</h3>
                <p>Yes, you can update your event details at any time. Simply log in to your organizer account, go to your dashboard, find the event you want to edit, and click on the "Edit" button.</p>
            </div>
            
            <div style="margin-top: 1.5rem;">
                <h3>How do I register for an event?</h3>
                <p>To register for an event, navigate to the event page and click on the "Register" button. You may need to create an account or log in if you haven't already.</p>
            </div>
            
            <div style="margin-top: 1.5rem;">
                <h3>What if I need to cancel my registration?</h3>
                <p>If you need to cancel your registration, log in to your account, go to "My Events" section, find the event you registered for, and click on "Cancel Registration".</p>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>