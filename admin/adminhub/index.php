
<?php 

	session_start();

	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header("Location: ../login.php");
		exit;
	}

	include '../../config.php';

	$query = "SELECT MAX(id) AS last_id FROM home_table";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $lastId = $result['last_id'];

    function getMaxId($pdo, $table) {
        $query = "SELECT MAX(id) AS last_id FROM $table";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['last_id'];
    }

    function getDataById($pdo, $table, $id) {
        $query = "SELECT * FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $lastIdhome = getMaxId($pdo, 'home_table');
    $dataHome = getDataById($pdo, 'home_table', $lastIdhome);

	$messages = []; 

	$sql = "SELECT * FROM message_table";
	$result = $pdo->query($sql);

	if ($result) {
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$messages[] = $row;
		}
	}

	$lastIdabout = getMaxId($pdo, 'about_table');
	$dataAbout = getDataById($pdo, 'about_table', $lastIdabout);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>Admin Panel</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Admin Panel</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#" onclick="showHomepage()">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Homepage</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="loadabout()">
					<i class='bx bxs-user'></i>
					<span class="text">About Section</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="showMessages()">
					<i class='bx bxs-message'></i>
					<span class="text">Messages</span>
				</a>
			</li>
		</ul>
		
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div id="Homepage">
				<div class="head-title">
					<div class="left">
						<h1 style="margin-bottom: 2rem;">Homepage</h1>
					</div>
				</div>
				
				<div class="databox">
					<div class="img_div">
						<div class="field">
							<label for="image" style="text-align: center; font-size: 20px;">Profile Image</label>
							<?php
								$mime_type = 'image/jpg'; 
						
								$base64_image = base64_encode($dataHome['image']); 
								
								$data_uri = "data:$mime_type;base64,$base64_image";
								
								echo "<img src=\"$data_uri\" width=\"250\" height=\"350\" alt=\"Home Image\" class=\"img-cover\">";
							?>
						</div>
					</div>
					
					<div class="label_div">
						<div class="field">
							<label for="name">Name:</label>
							<p><?php echo $dataHome['name'] ?></p>
						</div>
						<div class="field">
							<label for="quote1">Banner Quote :</label>
							<p><?php echo $dataHome['quote1'] ?></p>
						</div>
						<div class="field">
							<label for="quote2">Banner Quote below:</label>
							<p><?php echo $dataHome['quote2'] ?></p>
						</div>
						<div class="btn_clss">
							<button class="btn_add">Add</button>
							<button class="btn_update" onclick="showEditPage()">Update</button>
						</div>
						
					</div>
					
				</div>
			</div>

			<div class="container" id="homeEdit">
				<div class="head-title">
						<div class="left">
							<h1 style="margin-bottom: 2rem;">Edit Page</h1>
						</div>
				</div>
				<form action="update_data.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $lastIdhome; ?>">
					<div class="left-side">
						<label for="name">Name:</label>
						<input type="text" name="name" id="name" class="input-field" placeholder="Enter your name">

						<label for="banner-quote">Banner Quote:</label>
						<input type="text" name="banner-quote" id="banner-quote" class="input-field large-input-field" placeholder="Enter your banner quote">

						<label for="banner-quote-below">Banner Quote Below:</label>
						<input type="text" name="banner-quote-below" id="banner-quote-below" class="input-field large-input-field" placeholder="Enter your banner quote below">

						<label for="profile-image">Profile Image:</label>
						<input type="file" name="profile-image" id="profile-image" class="input-field" accept="image/*" placeholder="Upload your profile image">
						
						<button class="btno">Submit</button>
					</div>
				</form>

				<div class="right-side">
					<div class="preview-title" id="previewTitle">Preview</div>
					<div class="image-preview" id="imagePreview"></div>
				</div>
			</div>

			<!-- Message Container -->
			<div class="messageContainer" id="messagediv">
				<div class="header">Messages</div>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Message</th>
							<th>Operation</th>
						</tr>
					</thead>
						<?php foreach ($messages as $message): ?>
							<tr>
								<td><?php echo $message['id']; ?></td>
								<td><?php echo $message['user']; ?></td>
								<td><?php echo $message['email']; ?></td>
								<td><?php echo $message['phone']; ?></td>
								<td><?php echo $message['message']; ?></td>
								<td><button class="delete-btn" data-id="<?php echo $message['id']; ?>">Delete</button></td>
							</tr>
						<?php endforeach; ?>
					</table>
			</div>

			<div id="aboutSection">
				<div class="head-title">
					<div class="left">
						<h1 style="margin-bottom: 2rem;">About Me</h1>
					</div>
				</div>
				
				<div class="databox">
					<div class="img_div">
						<div class="field">
							<label for="image" style="text-align: center; font-size: 20px;">About Image</label>
							<?php
								$mime_type = 'image/jpg'; 
						
								$base64_image = base64_encode($dataAbout['aboutimage']); 
								
								$data_uri = "data:$mime_type;base64,$base64_image";
								
								echo "<img src=\"$data_uri\" width=\"250\" height=\"350\" alt=\"Home Image\" class=\"img-cover\">";
							?>
						</div>
						<div class="field">
							<label for="quote2">Email</label>
							<p><?php echo $dataAbout['email'] ?></p>
						</div>
						<div class="field">
							<label for="name">Facebook</label>
							<p><?php echo $dataAbout['facebook'] ?></p>
						</div>
						<div class="field">
							<label for="name">Instagram</label>
							<p><?php echo $dataAbout['instagram'] ?></p>
						</div>
						<div class="btn_clss">
							<button class="btn_add">Add</button>
							<button class="btn_update" onclick="loadaboutEdit()">Update</button>
						</div>
					</div>
					
					<div class="label_div">
						<div class="field">
							<label for="quote1">About Quote</label>
							<p><?php echo $dataAbout['about_quote'] ?></p>
						</div>
						<div class="field">
							<label for="quote2">Description</label>
							<p><?php echo $dataAbout['description'] ?></p>
						</div>
						<div class="field">
							<label for="name">Name</label>
							<p><?php echo $dataAbout['name'] ?></p>
						</div>
						<div class="field">
							<label for="quote1">Phone</label>
							<p><?php echo $dataAbout['phone'] ?></p>
						</div>
						<div class="field">
							<label for="name">LinkedIn</label>
							<p><?php echo $dataAbout['linkedin'] ?></p>
						</div>
						<div class="field">
							<label for="name">Git Hub</label>
							<p><?php echo $dataAbout['github'] ?></p>
						</div>
						
					</div>
					
				</div>
			</div>

			<div class="form-container" id="aboutSectionEdit">
				<h2>About Section</h2>
				<form action="update_about_data.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $lastIdabout; ?>">
					<div class="form-group">
						<label for="quote">Quote:</label>
						<input type="text" id="quote" name="quote" placeholder="Enter your quote">
					</div>
					<div class="form-group">
						<label for="description">Description:</label>
						<textarea id="description" name="description" placeholder="Enter your description"></textarea>
					</div>
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" id="name" name="name" placeholder="Enter your name">
					</div>
					<div class="form-group">
						<label for="phone">Phone:</label>
						<input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" id="email" name="email" placeholder="Enter your email address">
					</div>
					<div class="form-group">
						<label for="facebook">Facebook:</label>
						<input type="text" id="facebook" name="facebook" placeholder="Enter your Facebook profile URL">
					</div>
					<div class="form-group">
						<label for="instagram">Instagram:</label>
						<input type="text" id="instagram" name="instagram" placeholder="Enter your Instagram profile URL">
					</div>
					<div class="form-group">
						<label for="linkedin">LinkedIn:</label>
						<input type="text" id="linkedin" name="linkedin" placeholder="Enter your LinkedIn profile URL">
					</div>
					<div class="form-group">
						<label for="github">GitHub:</label>
						<input type="text" id="github" name="github" placeholder="Enter your GitHub profile URL">
					</div>
					<div class="form-group">
						<label for="about-image">About Image:</label>
						<div class="file-input">
							<input type="file" id="about-image" name="about-image">
							<label for="about-image" class="file-label">Choose File</label>
							<span class="file-name"></span>
						</div>
					</div>
					<button type="submit" class="submit-btn">Submit</button>
				</form>
			</div>
			
			

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
	<script>
		function showEditPage() {
			document.getElementById('homeEdit').style.display = 'block';
			document.getElementById('Homepage').style.display = 'none';
			document.getElementById('messagediv').style.display = 'none';
			document.getElementById('aboutSection').style.display = 'none';
			document.getElementById('aboutSectionEdit').style.display = 'none';
		}

		function showMessages() {
			document.getElementById('messagediv').style.display = 'block';
			document.getElementById('Homepage').style.display = 'none';
			document.getElementById('homeEdit').style.display = 'none';
			document.getElementById('aboutSection').style.display = 'none';
			document.getElementById('aboutSectionEdit').style.display = 'none';
		}

		function showHomepage() {
			document.getElementById('Homepage').style.display = 'block';
			document.getElementById('messagediv').style.display = 'none';
			document.getElementById('homeEdit').style.display = 'none';
			document.getElementById('aboutSection').style.display = 'none';
			document.getElementById('aboutSectionEdit').style.display = 'none';
		}

		function loadabout() {
			document.getElementById('aboutSection').style.display = 'block';
			document.getElementById('Homepage').style.display = 'none';
			document.getElementById('homeEdit').style.display = 'none';
			document.getElementById('messagediv').style.display = 'none';
			document.getElementById('aboutSectionEdit').style.display = 'none';
		}

		function loadaboutEdit() {
			document.getElementById('aboutSection').style.display = 'none';
			document.getElementById('Homepage').style.display = 'none';
			document.getElementById('homeEdit').style.display = 'none';
			document.getElementById('messagediv').style.display = 'none';
			document.getElementById('aboutSectionEdit').style.display = 'block	';
		}

		function previewImage(event) {
        var reader = new FileReader();
        var imagePreview = document.getElementById('imagePreview');
        var previewTitle = document.getElementById('previewTitle');

        reader.onload = function() {
            var imgElement = document.createElement('img');
            imgElement.src = reader.result;
            imgElement.alt = "Image Preview";

            
            imagePreview.innerHTML = '';

            imagePreview.appendChild(imgElement);

            previewTitle.style.display = 'none';
        }

        reader.readAsDataURL(event.target.files[0]);
		}
		
		document.getElementById('profile-image').addEventListener('change', previewImage);

		
		document.addEventListener('DOMContentLoaded', function() {
			var deleteButtons = document.querySelectorAll('.delete-btn');
			deleteButtons.forEach(function(button) {
				button.addEventListener('click', function() {
					var id = this.getAttribute('data-id');
					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'delete_message.php', true);
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					xhr.onreadystatechange = function() {
						if (xhr.readyState == 4 && xhr.status == 200) {
							var response = JSON.parse(xhr.responseText);
							if (response.success) {
								var row = button.parentNode.parentNode;
								row.parentNode.removeChild(row);
								alert('Message deleted successfully');
							} else {
								alert('Failed to delete message');
							}
						}
					};
					xhr.send('id=' + id);
				});
			});
		});

	</script>
	
</body>
</html>