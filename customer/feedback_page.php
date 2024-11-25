<!-- set page name and import html head -->
<?php
$pagename = "Give us your feedback!";
include("head.php");
include("connect.php");
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>

<div class="main">
    <div style="padding: 30px; text-wrap: wrap;">
        <h1>We Value Your Feedback!</h1> <br>
        <p>
            At <strong>Cook's Companion</strong>, we are always looking for ways to improve your shopping experience.
            Your feedback helps us understand what we’re doing well and where we can do better. Whether you have
            suggestions, compliments, or concerns, we’d love to hear from you!
        </p>
        <p>
            Please use the form below to share your thoughts. Our team reviews all feedback and will get back to you
            if a response is needed.
        </p>

        <h2>Feedback Form</h2>
        <div style="border: 0.1px solid #0000001d;background-color:aliceblue; padding:20px; border-radius: 15px; max-width: 700px; ">

            <form action="#" method="POST" class="feedback-form" style="display:flex;flex-direction: column;gap: 20px">
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
                    <input type="text" id="subject" name="subject" placeholder="Subject of your feedback" required>
                </div>

                <div>
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" placeholder="Write your feedback here" required></textarea>
                </div>
                <div>

                    <label for="rating">Rate Your Experience:</label>
                    <select id="rating" name="rating" required>
                        <option value="" disabled selected>Select a rating</option>
                        <option value="5">Excellent</option>
                        <option value="4">Very Good</option>
                        <option value="3">Good</option>
                        <option value="2">Fair</option>
                        <option value="1">Poor</option>
                    </select>
                </div>
                <div>
                    <input type="submit" class="hero-button" name="submit" style="padding: 5px">
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $rating = $_POST['rating'];

            try {
                $sql = "INSERT INTO feedback (name, email, subject, message, rating) 
                VALUES (:name, :email, :subject, :message, :rating)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':subject', $subject);
                $stmt->bindParam(':message', $message);
                $stmt->bindParam(':rating', $rating);

                $stmt->execute();

                echo '<p>
                Thank you for taking the time to share your thoughts with us. We truly appreciate your input and
                look forward to serving you better!
            </p>';
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        ?>
        <div class="other-feedback">
            <h3>Recent Customer Feedback</h3>

            <!-- show the latest 5 feedbacks -->
            <?php
            $sql = "SELECT * from feedback ORDER BY feedback_id DESC";
            $stmt = $pdo->query($sql);
            $messages = $stmt->fetchALL(PDO::FETCH_ASSOC);
            foreach (array_slice($messages, 0, 5) as $msg):  ?>
                <div>
                    <div><?= $msg['name'] ?>:</div>
                    <div><h4><?= $msg['subject']?></h4></div>
                    "<?= $msg['message'] ?>"
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>