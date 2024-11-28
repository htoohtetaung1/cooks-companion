<!-- set page name and import html head -->
<?php
$pagename = "Let us know if you need anything!";
include("head.php");
include("connect.php");
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>

<div class="main">
    <div style="padding: 30px; text-wrap: wrap;max-width: 1000px;text-align:justify;">
        <h2>Send Us A Message!</h2> 
        
        <p>
            Please use the form below to send us a message. Our team will respond to your messages and questions as soon as possible!
        </p>

        <h2>Message Form</h2>
        <div style="border: 0.1px solid #0000001d;background-color:aliceblue; padding:20px; border-radius: 15px; max-width: 700px; ">

            <form action="message_page.php" method="POST" class="feedback-form popup-form" style="display:flex;flex-direction: column;gap: 20px">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Your name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Your email" required>
                </div>

                <div>
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject of your message" required>
                </div>

                <div>
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" placeholder="Write your message or question here" required></textarea>
                    <input type="hidden" name="msg_form" value="msg_form">
                </div>
                
                <div>
                    <button name="msg-submit" class="hero-button show-popup-btn">Send Message</button>
                            <!-- Overlay -->
                            <div class="popup-overlay"></div>
            
                            <!-- Popup -->
                            <div class="popup" id="popup">
                                <p>Thanks for messaging us. We'll get back to you as soon as possible via email!</p>
                                <button class="close-popup-btn hero-button">Close</button>
                            </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST['msg_form']) && $_POST['msg_form'] === 'msg_form') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $replied = 'F';
            try {
                $sql = "INSERT INTO messages (name, email, subject, message,replied) 
                VALUES (:name, :email, :subject, :message, :replied)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':subject', $subject);
                $stmt->bindParam(':message', $message);
                $stmt->bindParam(':replied', $replied);

                $stmt->execute();
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        ?>
        
    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>