<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Neev Play School Enquiry Form</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


	<style>
		.form-label {
			font-size: 16px;
			font-weight: 700;
			text-align: left !important;
		}

		p {
			font-size: 16px;
		}

		body {
			background-color: #b3d4fc;
		}

		.card-header {
			background-color: white;
		}

		@media only screen and (max-width: 600px) {
			#main {
				margin-top: 0px;
				margin-bottom: 0px;
				width: 100%;
				height: 100%;
			}
		}

		h2 {
			font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
		}
	</style>
</head>

<body>
	<div class='row'>
		<div class='col col-2' id='spacer'>
		</div>
		<div class='col col-8 my-5' id='main'>
			<div class="card border-danger" style="font-size:14px;">
				<div class="card-header text-center">
					<img src="<?php echo base_url(); ?>assets/school_logo/logo.png" width="170px" height="170px"><br>
					
					<p><?php echo $school_setting[0]->School_Address; ?></p>
				</div>
				<div class="card-body">
					<h4 class="card-title text-center">ENQUIRY FORM</h4>
					<div class="container-sm mt-5">
						<form id='adm_form' method="POST" action="<?php echo base_url('Admission_registar/save_admission_form'); ?>">
							<div class="mb-3">
								<label for="childName" class="form-label">Applicant's Name</label>
								<input type="text" autocapitalize='on' class="form-control" id="childName" name='childName' placeholder="Enter child's name" required>
							</div>
							<div class="mb-3">
								<label for="parentName" class="form-label">Father's Name</label>
								<input type="text" autocapitalize='on' class="form-control" id="parentfName" name='parentfName' placeholder="Enter father's name" required>
							</div>
							<div class="mb-3">
								<label for="parentName" class="form-label">Mother's Name</label>
								<input type="text" autocapitalize='on' class="form-control" id="parentmName" name='parentmName' placeholder="Enter mother's name" required>
							</div>
							<!-- <div class="mb-3">
								<label for="dob" class="form-label">Date of Birth</label>
								<input type="date" class="form-control" id="dob" name='dob' required>
							</div> -->
							<div class="mb-3">
								<label for="phone" class="form-label">Phone Number</label>
								<input type="tel" class="form-control" id="phone" name='phone' onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" placeholder="Enter phone number" required>
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">E-mail Id</label>
								<input type="email" class="form-control" id="email" name='email' placeholder="Enter Email Id" required>
							</div>
							<? // rowhit 
							?>
							<div class="mb-3">
								<label for="dob" class="form-label">Date of Birth</label>
								<input type="date" class="form-control" id="dob" name='dob' onchange="updateClassOptions()" required>
							</div>
							<div class="mb-3">
								<label for="class" class="form-label">Class Applying For</label>
								<select class="form-select" id="classs" name='classs' required>
									<option value="">Select Class</option>
								</select>
							</div>
							
							<div class="mb-3">
								<label for="paddress" class="form-label">Permanent Address</label>
								<textarea class="form-control" id="paddress" name='paddress' rows="3" placeholder="Enter address" required></textarea>
							</div>
							<div class="mb-3">
								<label for="caddress" class="form-label">Communication Address</label>
								<textarea class="form-control" id="caddress" name='caddress' rows="3" placeholder="Enter address" required></textarea>
							</div>

							<center><button type="submit" class="btn btn-primary">SUBMIT</button></center>
							<br>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class=' col col-2' id='spacer'>

		</div>

	</div>
	<!-- Bootstrap Bundle JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
<script>
	//rowhit
	function updateClassOptions() {
		const dobInput = document.getElementById('dob');
		const classSelect = document.getElementById('classs');
		const dob = new Date(dobInput.value);
		if (isNaN(dob)) {
			alert("Please enter a valid date.");
			return; 
		}
		const today = new Date();
		const age = today.getFullYear() - dob.getFullYear();
		const monthDiff = today.getMonth() - dob.getMonth();

		if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
			age--;
		}

		classSelect.innerHTML = '<option value="">Select Class</option>';
		if (age < 2) {
			classSelect.innerHTML += '<option value="Mother Toddler">Mother Toddler</option>';
		} else if (age >= 2 && age < 3) {
			classSelect.innerHTML += '<option value="Toddler">Toddler</option>';
		} else if (age >= 3 && age < 4) {
			classSelect.innerHTML += '<option value="Nursery">Nursery</option>';
		} else if (age >= 4 && age < 5) {
			classSelect.innerHTML += '<option value="UKG">UKG</option>';
		} else if (age >= 5 && age < 6) {
			classSelect.innerHTML += '<option value="Prep/Sr.KG">Prep/Sr.KG</option>';
		}
	}
	$("#adm_form").on("submit", function(event) {
		event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('Admission_registar/save_admission_form'); ?>",
			type: "POST",
			data: $('#adm_form').serialize(),
			success: function(data) {
				if (data == 1) {
					Swal.fire({
						title: "Thank You for Your Response!",
						html: "You'll be contacted within 24-48 hrs.",
						timer: 10000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
							const timer = Swal.getPopup().querySelector("b");
							timerInterval = setInterval(() => {
								timer.textContent = `${Swal.getTimerLeft()}`;
							}, 100);
						},
						willClose: () => {
							clearInterval(timerInterval);
							window.location.href = 'http://neevastrongfoundation.org';
						},
					}).then((result) => {
						/* Read more about handling dismissals below */
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location.href = 'http://neevastrongfoundation.org';
						}
					});
				}
			},
		});
	});
        
</script>

</html>