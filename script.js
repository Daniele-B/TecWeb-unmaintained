//function to close the login modal with button
function closeLoginModal() {
	document.getElementById('LoginModal').style.display='none';
}

//function to close the singh in modal with button
function closeSignUpModal() {
	document.getElementById('SignUpModal').style.display='none';
}

//function to close the edit profile Modal with button
function closeEditProfileModal() {
	document.getElementById('EditProfileModal').style.display='none';
}

//function to open the login modal
function openLoginModal() {
	document.getElementById('LoginModal').style.display='block';
}

//function to open the sign in Modal
function openSignUpModal() {
	document.getElementById('SignUpModal').style.display='block';
}

//function to open the edit profile Modal
function openEditProfileModal() {
	document.getElementById('EditProfileModal').style.display='block';
}

//function to close the  modal clicking outside
function eventListnerforLoginModal() {

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target === document.getElementById('LoginModal')) {
			document.getElementById('LoginModal').style.display = "none";
		}
		if (event.target === document.getElementById('SignUpModal')) {
			document.getElementById('SignUpModal').style.display = "none";
		}
		if (event.target === document.getElementById('EditProfileModal')) {
			document.getElementById('EditProfileModal').style.display = "none";
		}
		if (event.target === document.getElementById('SearchModal')) {
			document.getElementById('SearchModal').style.display = "none";
		}
	}
}
//function to login using ajax
function doLogin(event) {
	event.preventDefault()//prevents to reload the page if login data arent correct

	// creating ajax object
	var xhttp;
	if (window.XMLHttpRequest) {
	// code for modern browsers
	xhttp = new XMLHttpRequest();
	} else {
	// code for IE6, IE5
	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	//calback function for the request
	xhttp.onreadystatechange = function() {
	if (this.readyState === 4 && this.status === 200) {
		//if status is ok
		if(this.responseText==="Success")
			location.reload();
		else
			document.getElementById("InvalidLogin").innerHTML = this.responseText;

	}
	};
	//getting the values of the fields
	var usr=document.getElementById('usr').value;
	var pwd=document.getElementById('pwd').value;

	//doing th ajax request
	xhttp.open("POST", "doLogin.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("usr="+usr+"&pwd="+pwd);

  return false;
}

//function to lofOut using ajax
function doLogOut(event) {

	// creating ajax object
	var xhttp;
	if (window.XMLHttpRequest) {
	// code for modern browsers
	xhttp = new XMLHttpRequest();
	} else {
	// code for IE6, IE5
	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	//calback function for the request
	xhttp.onreadystatechange = function() {
	if (this.readyState === 4 && this.status == 200) {
		//if status is ok
		if(this.responseText=="success"){
			location.reload();//reload page if logged out

		}

	}
	};
	//doing th ajax request
	xhttp.open("POST", "doLogOut.php", true);
	xhttp.send();

}


//function to Singh Up using ajax
function doSignUp(event) {
	event.preventDefault()//prevents to reload the page if login data arent correct

	// creating ajax object
	var xhttp;
	if (window.XMLHttpRequest) {
	// code for modern browsers
	xhttp = new XMLHttpRequest();
	} else {
	// code for IE6, IE5
	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	//calback function for the request
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//if status is ok
		if(this.responseText==="Success"){
			location.reload();
		}else{
			document.getElementById("SignUpMessage").innerHTML = this.responseText;
		}

	}
	};
	//getting the values of the fields
	var usr=document.getElementById('usrSighUp').value;
	var pwd=document.getElementById('pwdSignUp').value;
	var name=document.getElementById('name').value;
	var surname=document.getElementById('surname').value;
	//doing th ajax request
	xhttp.open("POST", "doSignUp.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("usr="+usr+"&pwd="+pwd+"&name="+name+"&surname="+surname);

  return false;
}



//function to Edit Profile using ajax
function doEditProfile(event) {
	event.preventDefault()//prevents to reload the page if login data arent correct

	// creating ajax object
	var xhttp;
	if (window.XMLHttpRequest) {
	// code for modern browsers
	xhttp = new XMLHttpRequest();
	} else {
	// code for IE6, IE5
	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	//calback function for the request
	xhttp.onreadystatechange = function() {
	if (this.readyState === 4 && this.status === 200) {
		//if status is ok
		document.getElementById("EditProfileMessage").innerHTML = this.responseText;

	}
	};
	//getting the values of the fields
	var usr=document.getElementById('usrEdit').value;
	var pwd=document.getElementById('pwdEdit').value;
	var name=document.getElementById('nameEdit').value;
	var surname=document.getElementById('surnameEdit').value;
	//doing th ajax request
	xhttp.open("POST", "doEditProfile.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("usr="+usr+"&pwd="+pwd+"&name="+name+"&surname="+surname);

  return false;
}

//drobdown menu event
function openDrobDownMenu(btn) {
    var x = document.getElementById("Topnav");
    if (x.className === "menu") {
        x.className += " responsive";
    } else {
        x.className = "menu";
    }
	btn.classList.toggle("rotate");

}

function openSearchModal(){
	document.getElementById('SearchModal').style.display='block';
}

//function to close the login modal with button
function closeSearchModal() {
	document.getElementById('SearchModal').style.display='none';
}

/*
Delete function
*/
function btnDeleteOnClick(obj){
	if(confirm("Do you really want to delete this image?")){
		// creating ajax object
		var xhttp;
		var thisId = obj.id.substring("DelBtn_".length);;
		var nomeArtista = thisId.substring(0,thisId.indexOf('_'));
    	var nomeImmagine = thisId.substring(thisId.indexOf('_')+1);
		if (window.XMLHttpRequest) {
			// code for modern browsers
			xhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		//calback function for the request
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//if status is ok
				if(this.responseText == "1"){//Item deleted with success
					location.reload();
				}else if(this.responseText == "-1" || this.responseText == "Connection Error"){//Error
					alert('Error');
				}
			}
		};
		//doing th ajax request
		xhttp.open("POST", "deleteItem.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("art="+nomeArtista+"&nomeImg="+nomeImmagine);
	}
}

/*
Function by page gallery.php
*/
function btnLikeOnClick(obj){
	// creating ajax object
	var xhttp;
	var thisId = obj.id;
	thisId = thisId.substring(("LikeBtn_").length);
	var nomeArtista = thisId.substring(0,thisId.indexOf('_'));
    var nomeImmagine = thisId.substring(thisId.indexOf('_')+1);
	if (window.XMLHttpRequest) {
        // code for modern browsers
        xhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    //calback function for the request
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //if status is ok
            if(this.responseText=="0"){//finestra di login
                openLoginModal();
            }else if(this.responseText == "1"){//like inserito
                obj.classList.add("like-btn-added");
            }else if(this.responseText == "2"){//like rimosso
                obj.classList.remove("like-btn-added");
            }else{//errore
                alert("Errore");
			}
			if((window.location.href).indexOf("likedItems.php")!== -1){//it means the current page is likedItems
				location.reload();
			}else if(this.responseText == "1" || this.responseText == "2"){
				updateLikeCounter(nomeArtista,nomeImmagine);
			}
        }
	};
	//doing th ajax request
	xhttp.open("POST", "giveLike.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("art="+nomeArtista+"&nomeImg="+nomeImmagine);
}

//function used to update the like counter of an image
function updateLikeCounter(nomeArtista,nomeImmagine){
	// creating ajax object
	var xhttp;
	var obj = document.getElementById("Likes_"+nomeArtista+"-"+nomeImmagine);
	if (window.XMLHttpRequest) {
        // code for modern browsers
        xhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    //calback function for the request
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //if status is ok
            if(this.responseText=="Connection Error"){
                obj.innerHTML = "Likes: 0";
            }else{
				obj.innerHTML = "Likes: "+this.responseText;
			}
        }
	};
	//doing th ajax request
	xhttp.open("POST", "getLikes.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("art="+nomeArtista+"&nomeImg="+nomeImmagine);
}

//onclick function for pagination buttons
function btnPaginationOnClick(id){
	var arr = document.querySelectorAll('[id^="galImgDiv"]');
	for(i=0; i< arr.length; i++){ //hide all the divs
		var item = arr[i];
		item.classList.remove('display-block');
		item.classList.add('display-none');
	}
	var divNumber = id.substring("btnPagination".length,id.length);
	
	//show only one gallery images container div 
	document.querySelector('[id="galImgDiv'+divNumber+'"]').classList.remove('display-none');
	document.querySelector('[id="galImgDiv'+divNumber+'"]').classList.add('display-block');
	//remove active status to all pagination buttons
	var arr=document.querySelectorAll('[id^="btnPagination"]');
	for(i=0; i< arr.length; i++){
		var item = arr[i];
		item.classList.remove('btnPaginationActive');
	}
	
	document.querySelector('[id="btnPagination'+divNumber+'"]').classList.add('btnPaginationActive');
	/*
	document.getElementById("btnPagBack").classList.remove("btnPaginationDeactive");
	document.getElementById("btnPagForward").classList.remove("btnPaginationDeactive");
	*/
	//document.getElementById("btnPagBack").classList.remove("display-none");
	//document.getElementById("btnPagForward").classList.remove("display-none");
	document.getElementById("btnPagBack").style.display = 'block';
	document.getElementById("btnPagForward").style.display = 'block';
	if(divNumber == 1){//if it is the first btn of pagination
		//document.getElementById("btnPagBack").classList.add("btnPaginationDeactive");
		//document.getElementById("btnPagBack").classList.add("display-none");
		document.getElementById("btnPagBack").style.display = 'none';
	}
	if(divNumber == document.querySelectorAll('[id^="galImgDiv"]').length){
		//document.getElementById("btnPagForward").classList.add("btnPaginationDeactive");
		//document.getElementById("btnPagForward").classList.add("display-none");
		document.getElementById("btnPagForward").style.display = 'none';
	}
}

//btn pagination back on click
function btnPagBackOnClick(){
	var activeBtnPag = document.querySelector('.btnPaginationActive');
	var num = Number(activeBtnPag.id.substring("btnPagination".length,activeBtnPag.id.length));
	if (num > 1){
		btnPaginationOnClick("btnPagination"+(num-1));
	}
}

//btn pagination forward on click
function btnPagForwardOnClick(){
	var activeBtnPag = document.querySelector('.btnPaginationActive');
	var num = Number(activeBtnPag.id.substring("btnPagination".length,activeBtnPag.id.length));
	if (num < document.querySelectorAll('[id^="galImgDiv"]').length){
		btnPaginationOnClick("btnPagination"+(num+1));
	}
}

function populateImages(){
	var arr = document.querySelectorAll('.galleryFigureWrapper');
	for(i=0; i< arr.length; i++){
		var item = arr[i];
		var id = item.id;
		var artista = document.querySelector('[id="'+id+'"] [name="nameArtist"]').value;
		var immg = document.querySelector('[id="'+id+'"] [name="nameImage"]').value;
		var imgSrc = document.getElementById("img_"+artista+"-"+immg).src;
		var divImg = document.querySelector('[id="'+id+'"] .image-div').style.backgroundImage = "url('"+imgSrc+"')";
	}
}