<?php
include("connect.php");
session_start();

switch ($_POST['form']) {

	case 'displaychatusers':
		if ($_POST['srchprod'] != '') {
			$searchcontact = "AND (CASE WHEN b.middlename = '' OR b.middlename IS NULL THEN CONCAT(b.lastname, ', ', b.firstname) ELSE CONCAT(b.lastname, ', ', b.firstname, ' ', LEFT(b.middlename, '1'), '.') END LIKE '%" . $_POST['srchprod'] . "%')";
		} else {
			$searchcontact = "";
		}

		$res = mysqli_query($connection, "SELECT CASE WHEN b.middlename = '' OR b.middlename IS NULL THEN CONCAT(b.lastname, ', ', b.firstname) ELSE CONCAT(b.lastname, ', ', b.firstname, ' ', LEFT(b.middlename, '1'), '.') END, a.DATETIME_LOG, a.user_id, a.sendto, b.usertype FROM chats AS a LEFT JOIN users_table AS b ON a.user_id = b.user_id WHERE a.sendto = '" . $_SESSION['user_id'] . "' AND type = 'ADMIN' " . $searchcontact . " GROUP BY a.user_id ORDER BY a.DATETIME_LOG DESC");
		$numrows = mysqli_num_rows($res);
		if ($numrows == TRUE) {
			while ($row = mysqli_fetch_array($res)) {

				if ($row[4] == "CUSTOMER") {
					$usertypesmall = "Customer";
				} elseif ($row[4] == "SELLER") {
					$usertypesmall = "Seller";
				}

				echo "<li onclick='displaychats(\"" . $row[2] . "\", \"" . $row[3] . "\")'>
	                        <a href='javascript:void(0)'><img src='../admin/assets/images/profile4.png' alt='user-img' class='img-circle'> <span><b>" . $row[0] . "</b><small class='text-success'>" . $usertypesmall . "</small></span></a>
	                    </li>";
			}
		} else {
			echo "<h6 style='margin-top: 20px; font-weight: 300; color:#afafaf; text-align:center;'><i> No Conversation Found . . .  </i></h6>";
		}
		break;

	case 'displaychats':
		$res = mysqli_query($connection, "SELECT message, user_id, image_path, DATETIME_LOG FROM chats WHERE (user_id = '" . $_POST['user_id'] . "' AND sendto = '" . $_POST['sendtoID'] . "') OR (user_id = '" . $_POST['sendtoID'] . "' AND sendto = '" . $_POST['user_id'] . "') ");
		$numrows = mysqli_num_rows($res);

		if ($numrows > 0) {
			while ($row = mysqli_fetch_array($res)) {
				$userIsAdmin = ($_POST['usertype'] == "ADMIN");
				$isCurrentUser = ($row['user_id'] == $_SESSION['user_id']);

				echo "<li class='" . ($isCurrentUser ? 'reverse' : '') . "' style='margin-top: 0px;margin-bottom:30px;'>";
				echo "<div class='chat-content'>";

				// Display message box based on user type
				echo "<div class='box " . ($userIsAdmin ? 'bg-light-info' : 'bg-light-inverse') . "'>" . $row['message'] . "</div>";

				// Check if there is an image associated with the message
				if (!empty($row['image_path'])) {
					echo "<div><img src='" . $row['image_path'] . "' width='200px'></div>";
				}

				echo "</div>";

				// Display user image and timestamp
				if ($isCurrentUser) {
					// Display your profile image and timestamp on the right
					echo "<div class='chat-img' style='float: right;'><img src='../admin/assets/images/profile4.png' alt='user' /></div>";
				} else {
					// Display chatmate's profile image and timestamp on the left
					echo "<div class='chat-img' style='float: left;'><img src='../admin/assets/images/profile2.png' alt='user' /></div>";
				}

				echo "<div class='chat-time'>" . date('g:i a', strtotime($row['DATETIME_LOG'])) . "</div>";
				echo "</li>";
			}
		} else {
			echo "<h5 style='margin-top: 20px; font-weight: 300; color:#afafaf; text-align:center;'><i> No Conversation Found . . .  </i></h5>";
		}
		break;
	case 'sendbutton':
		// Determine the recipient based on the session and posted data
		if ($_POST['textsendtoID'] == $_SESSION['user_id']) {
			$sendto = $_POST['textuser_id'];
		} else {
			$sendto = $_POST['textsendtoID'];
		}

		$message = !empty($_POST['textmessage']) ? $_POST['textmessage'] : null;
		$imagePath = '';

		// Check if an image was uploaded
		if (!empty($_FILES['imageFile'])) {
			$uploadDirectory = '../OmaangatImages/messageFile/'; // Set your upload directory
			$fileName = $_FILES['imageFile']['name'];
			$targetFilePath = $uploadDirectory . basename($fileName);

			// Check if the uploaded file is a valid image
			$check = getimagesize($_FILES['imageFile']['tmp_name']);
			if ($check !== false) {
				// Upload the image
				if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetFilePath)) {
					$imagePath = $targetFilePath;
				} else {
					echo "Error uploading image";
				}
			} else {
				echo "Invalid image format";
			}
		}

		// Insert chat record with message and image file path
		$send = mysqli_query($connection, "INSERT INTO chats SET user_id = '" . $_SESSION['user_id'] . "', message = '" . $message . "', image_path = '" . $imagePath . "', sendto = '" . $sendto . "', type = '" . $_POST['textadmin'] . "';");

		if ($send) {
			echo "Message and image sent successfully";
		} else {
			echo "Error sending message and image";
		}
		break;
	case 'fncupdatestatus':
		$row = mysqli_fetch_array(mysqli_query($connection, "SELECT status FROM messages_admin WHERE id = '" . $_POST['id'] . "'"));
		if ($row[0] == 1) {
			$updateappointment = mysqli_query($connection, "UPDATE messages_admin SET status = '0' WHERE id = '" . $_POST['id'] . "';");

			$addnotif = mysqli_query($connection, "INSERT INTO usernotifications SET user_id = '" . $_POST['user_id'] . "', logs = 'Admin viewed your message', username = 'admin';");
		} else {
		}
		break;
}
