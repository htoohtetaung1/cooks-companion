<!-- import header here -->
<?php
$pageName = 'Messages';
require_once("head.php");
require_once("connect.php");
require_once("data.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
?>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <!-- import spinner here -->
    <!-- Spinner End -->

    <!-- Sidebar Start -->
    <!-- import sidebar here -->
    <?php include("sidebar.php"); ?>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <!-- import navbar here -->
        <?php include("navbar.php"); ?>
        <!-- Navbar End -->

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h5 class="mb-4">Customer Messages </h5>
                        <?php
                        $sql = "SELECT * from messages ORDER BY message_id DESC";
                        $stmt = $pdo->query($sql);
                        $messages = $stmt->fetchALL(PDO::FETCH_ASSOC);

                        $sql = "SELECT * from messages WHERE replied = 'F'";
                        $stmt = $pdo->query($sql);
                        $unrepliedMessages = $stmt->fetchALL(PDO::FETCH_ASSOC);

                        ?>

                        <?php
                        echo 'Unreplied Messages = ' . count($unrepliedMessages) . '<br>';
                        echo 'Total Messages = ' . count($messages);
                        ?>
                        <div class="row d-flex g-10 flex-wrap flex-row">
                            <?php
                            foreach ($unrepliedMessages as $umsg): ?>
                                <div style="max-width:50%">
                                    <form action="messages.php" method="POST" class="form-control">
                                        <p><b>From:</b> <?= $umsg['name'] ?></p>
                                        <p><b>Email:</b> <?= $umsg['email'] ?></p>
                                        <p><b>Subject: </b><?= $umsg['subject'] ?></p>
                                        <p><b>Message:</b></p>
                                        <p><?= $umsg['message'] ?></p>
                                        <input type="hidden" name="message_id" value="<?= $umsg['message_id'] ?>">
                                        <input type="hidden" name="email" value="<?= $umsg['email'] ?>">
                                        <input type="hidden" name="name" value="<?= $umsg['name'] ?>">
                                        <input type="hidden" name="subject" value="<?= $umsg['subject'] ?>">
                                        <label for="reply_message" class="form-label">Reply:</label>
                                        <textarea style="margin-bottom: 10px;" name="reply_message" id="reply_message" required class="form-control" cols="30" rows="3"></textarea>
                                        <input type="submit" name="submit" value="Reply" class="btn btn-primary">
                                    </form>
                                </div>
                            <?php endforeach ?>
                            <?php
                            if (isset($_POST['submit'])) {
                                try {
                                    $subject = $_POST['subject'];
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $messageId = $_POST['message_id'];
                                    $replyMessage = $_POST['reply_message'];
                                    $replied = 'T';

                                    $sql = "UPDATE messages 
                                            SET reply_message = :reply_message, replied = :replied 
                                            WHERE message_id = :message_id";

                                    // Prepare the statement
                                    $stmt = $pdo->prepare($sql);

                                    // Bind the parameters
                                    $stmt->bindParam(':reply_message', $replyMessage, PDO::PARAM_STR);
                                    $stmt->bindParam(':replied', $replied, PDO::PARAM_STR);
                                    $stmt->bindParam(':message_id', $messageId, PDO::PARAM_INT);

                                    // Execute the query
                                    $stmt->execute();
                                    echo "Message updated successfully.";
                                    $mail = new PHPMailer(true);
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'cookscompanion.reply@gmail.com'; // Your email
                                    $mail->Password = 'gnmi ihvk jvcq adka'; // Your email password or app password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type
                                    $mail->Port = 587; // Typically 587 for TLS

                                    // Sender and recipient
                                    $mail->setFrom('cookscompanion.reply@gmail.com', "Cook's Companion");
                                    $mail->addAddress($email, $name); // Add recipient

                                    // Email content
                                    $mail->isHTML(true);
                                    $mail->Subject = 'Re: '. $subject;
                                    $mail->Body    = $replyMessage;
                                    $mail->AltBody = $replyMessage;

                                    try {
                                        // Send email
                                        $mail->send();
                                        echo "<script>
                                                    setTimeout(function() {
                                                        window.location.href = window.location.href;
                                                    }, 0);
                                                </script>";
                                    } catch (Exception $e) {
                                        echo "Couldn't send email";
                                        die($e->getMessage());
                                    }
                                } catch (Exception $e) {
                                    echo "Failed to update the message.";
                                    die($e->getMessage());
                                }
                            }

                            ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <?php
                                        if ($messages == null) {
                                            print '<h3>There are no messages!</h3>';
                                        } ?>
                                        <th scope="col">Message ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Reply Message</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($messages as $msg): ?>
                                        <tr>
                                            <td><?= $msg['message_id'] ?></td>
                                            <td><?= $msg['name'] ?></td>
                                            <td><?= $msg['email'] ?></td>
                                            <td><?= $msg['subject'] ?></td>
                                            <td>
                                                <p style="max-height: 120px; overflow-y: scroll;">
                                                    <?= $msg['message'] ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p style="max-height: 120px; overflow-y: scroll;">
                                                    <?php
                                                    if (empty($msg['reply_message'])) {
                                                        echo "<span style='color:red;'>NOT REPLIED</span>";
                                                    } else {
                                                        echo $msg['reply_message'];
                                                    }
                                                    ?>
                                                </p>
                                            </td>


                                        </tr>
                                    <?php endforeach ?>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->


        <!-- Footer Start -->
        <div class="pt-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">2024 Cook's Companion</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<?php include("jslibs.php");  ?>