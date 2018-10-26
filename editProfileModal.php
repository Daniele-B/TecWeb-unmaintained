
<!-- The Modal -->
<div id="EditProfileModal" class="Modal">
	<!-- Modal Content -->
	<form class="modal-content animate" method="post" action="" onsubmit="return doEditProfile(event)">
		<div class="modalHead">
			<span onclick="closeEditProfileModal()" class="close" title="Close Modal">&times;</span>
			<h1>Edit Profile</h1>
		</div>
		<div class="container">
			<label for="usrEdit">Username</label>
			<input id="usrEdit" type="text" placeholder="Enter Username" name="usrEdit" <?php echo 'value="'.$_SESSION["Username"].'"'; ?>readonly/>

			<label for="pwdEdit">Password</label>
			<input pattern=".{5,}"   required title="5 characters minimum" id="pwdEdit" type="password" placeholder="Enter Password" name="pwdEdit" required/>

			<label for="nameEdit">Name</label>
			<input id="nameEdit" type="text" placeholder="Enter Name" name="nameEdit" required/>

			<label for="surnameEdit">Surname</label>
			<input id="surnameEdit" type="text" placeholder="Enter Surname" name="surnameEdit" required/>

		</div>
		<div class="container" id="EditProfileMessage">
			<!--container for invalid login message-->

		</div>

		<div class="container modalFotter" >
			<button type="submit">Save</button>
			<button type="button" onclick="closeEditProfileModal()" class="cancelbtn">Cancel</button>
		</div>

	</form>
</div>