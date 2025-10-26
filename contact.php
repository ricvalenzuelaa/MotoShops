<?php
include 'header.php'; // New header
?>

<div class="form-container-boxed">
    <h2 class="section-title">Get in Touch</h2>
    
    <form class="contact-form" onsubmit="alert('Thank you for your message!'); return false;">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" placeholder="Your Name" required />
        </div>
        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email" id="email" placeholder="Your Email" required />
        </div>
        <div class="form-group">
            <label for="message">Your Message</label>
            <textarea id="message" rows="5" placeholder="Your Message" required></textarea>
        </div>
        <button type="submit" class="form-btn">Send Message</button>
    </form>
</div>

<?php
include 'footer.php'; // New footer
?>