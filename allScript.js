var account_id;
	function profile(){	
		var theUrl="http://52.89.116.249/~francis.kornu/carpool/profile.php";
				$.ajax(theUrl,
					{
					async:true,
					complete:profileComplete}
					);
	}

	function profileComplete(xhr,status){
				if(status!="success"){
					alert("error sending request");
					return;
				}
				var obj=$.parseJSON(xhr.responseText);

				if (obj.result==0){
    			alert("The system encounted a problem");
				window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
   			    }else{
   			    	var profile="";
					for (var i in obj.profile){
						profile += "<h4 style='text-align:center;'>"+"<img src='avatar.png' width=90 height=70 style='margin-left: 2%;border-radius: 65px;'>"+"</h4>";
						profile += "<div class='divider'>";
						profile += "</div>";
						profile += "<div class='card-panel'>";
						profile += "<h5>"+"Username: "+"<i>"+obj.profile[i].USERNAME+"</i>"+"</h5>";
						profile += "</div>";
						profile += "<div class='card-panel'>";
						profile += "<h6>"+"Full Name: "+"<b>"+obj.profile[i].FIRSTNAME+","+obj.profile[i].LASTNAME+"</b>"+"</h6>";
						profile += "</div>";
						profile += "<div class='card-panel'>";
						profile += "<h6>"+"Phone Number: "+"<b>"+obj.profile[i].PHONE_NUMBER+"</b>"+"</h6>";
						profile += "</div>";
						profile += "<div class='card-panel'>";
						profile += "<h6>"+"User ID : "+"<b>"+obj.profile[i].USER_ID+"</b>"+"</h6>";
						profile += "</div>";
						profile += "<div class='card-panel'>";
						profile += "<h6>"+"Email: "+"<b>"+obj.profile[i].EMAIL+"</b>"+"</h6>";
						profile += "</div>";
						profile += "<table>";
						profile += "<tr>";
						profile += "<td>"+"<a href='#myPool' onclick='myPools()' class='waves-effect #03A9F4 btn' id='joinP' style='color:black;margin-left:20%;width:70%'>"+"Pools"+"</a>"+"</td>";
						profile += "</tr>";
						profile += "</table>";
	 			}
	 			$("#profileContent").html(profile);
	}
}
	function myPools(){
		var theUrl="http://52.89.116.249/~francis.kornu/carpool/checkPools.php";
				$.ajax(theUrl,
					{
					async:true,
					complete:myPoolDetails}
					);
	}

	function myPoolDetails(xhr,status){
		if(status!="success"){
			alert("Error");
					return;
			}
			var obj=$.parseJSON(xhr.responseText);
			if (obj.result==0){
				alert("You have not created any pools OR the system encounted a problem");
				window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
				}
			var checkPool="";
					for (var i in obj.checkPools){
						checkPool += "<div class='divider'>";
						checkPool += "</div>";
						checkPool += "<div class='card-panel teal lighten-2'>";
						checkPool += "<h5>"+"By: "+"<i>"+"MySelf"+"</i>"+"</h5>";
						checkPool += "<h6>"+"Pool_ID: "+"<b>"+obj.checkPools[i].POOL_ID+"</b>"+"</h6>";
						checkPool += "<h6>"+"Name of Person: "+"<b>"+obj.checkPools[i].USERNAME+"</b>"+"</h6>";
						checkPool += "<h6>"+"Phone Number: "+"<b>"+obj.checkPools[i].PHONE_NUMBER+"</b>"+"</h6>";
						checkPool += "</div>";
					}
					$("#mPools").html(checkPool);
	}

	function displayAllDetails(xhr,status){						
				if(status!="success"){
			alert("Error");
					return;
			}
			var obj=$.parseJSON(xhr.responseText);
			
			if (obj.result==0){
				alert("Error");
				return;
				}
			var pdetails="";
					for (var i in obj.details){
						pdetails += "<div class='divider'>";
						pdetails += "</div>";
						pdetails += "<div class='card-panel teal lighten-2'>";
						pdetails += "<h5>"+"By: "+"<i>"+obj.details[i].USERNAME+"</i>"+"</h5>";
						pdetails += "</div>";
						pdetails += "<div class='card-panel teal lighten-2'>";
						pdetails += "<h6>"+"Number of Seats: "+"<b>"+obj.details[i].NUMBER_ALLOWED+"</b>"+"</h6>";
						pdetails += "</div>";
						pdetails += "<div class='card-panel teal lighten-2'>";
						pdetails += "<h6>"+"Number Joined: "+"<b>"+obj.details[i].NUMBER_JOINED+"</b>"+"</h6>";
						pdetails += "</div>";
						pdetails += "<div class='card-panel teal lighten-2'>";
						pdetails += "<h6>"+"Date : "+"<b>"+obj.details[i].DATE+"</b>"+"</h6>";
						pdetails += "</div>";
						pdetails += "<div class='card-panel teal lighten-2'>";
						pdetails += "<h6>"+"Time of Departure: "+"<b>"+obj.details[i].TIME+"</b>"+"</h6>";
						pdetails += "</div>";
						pdetails += "<div class='card-panel teal lighten-2'>";
						pdetails += "<h6>"+"Total Amount: "+"<b>"+obj.details[i].AMOUNT+"</b>"+"</h6>";
						pdetails += "</div>";
						pdetails += "<div class='card-panel'>";
						pdetails += "<b>Starting Location:</b> <iframe width='300' height='300' frameborder='0' id='google-map' src='http://maps.google.co.uk?q="+obj.details[i].START+"&maptype=satellite&z=60&output=embed'></iframe>";
						pdetails += "</div>";
						pdetails += "<div class='card-panel teal lighten-2'>";
						pdetails += "<h6>"+"End Location: "+"<b>"+obj.details[i].DESTINATION+"</b>"+"</h6>";
						pdetails += "</div>";
						pdetails += "<a href='#poolDetails' onclick='join(" + obj.details[i].POOL_ID+","+obj.details[i].OWNER+")' class='btn-floating waves-effect waves-light #004d40 teal darken-4' id='joinP' style='color:black;margin-left:90%'>"+"<i class='material-icons'>add</i>"+"</a>";
					}
					$("#pDetails").html(pdetails);
		            
	}

	function displayDetails(poolID){
	var theUrl="http://52.89.116.249/~francis.kornu/carpool/allPhp.php?cmd=8&poolid="+poolID;
				$.ajax(theUrl,
					{
					async:true,
					complete:displayAllDetails}
					);
	}

	function displayAll(xhr,status){
				if(status!="success"){
					 alert("Error occurred when checking");
					return;
				}
						
				var obj=$.parseJSON(xhr.responseText);
				if (obj.result==0){
				alert("The system encounted a problem");
				window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
				}
					var table="";
					for (var i in obj.apools){
						table += "<div class='divider'>";
						table += "</div>";
						table += "<div class='card-panel teal lighten-2'>";
						table += "<h5>"+"By: "+"<i>"+obj.apools[i].USERNAME+"</i>"+"</h5>";
						table += "<h6>"+"Starting Location: "+obj.apools[i].START+"</h6>";
						table += "<h6>"+"End Location: "+obj.apools[i].DESTINATION+"</h6>";
						table += "<a href='#poolDetails' onclick='displayDetails(" + obj.apools[i].POOL_ID + ")' class='btn-floating waves-effect waves-light #004d40 teal darken-4' id='joinP' style='color:black;margin-left:90%'>"+"<i class='material-icons'>add</i>"+"</a>";
						table += "</div>";
					}
					$("#allPools").html(table);
			}

	function displayPool(){
				var theUrl="http://52.89.116.249/~francis.kornu/carpool/allPhp.php?cmd=2";
				$.ajax(theUrl,
					{
					async:true,
					complete:displayAll}
					);
			}
	
	function createPool(){
		var numberAllow = $("#numberAllow").val();
		var date = $("#date").val();
		var location = $("#location").val();
		var userId = $("#userid").val();
        var time = $("#time").val();
      	var amount = $("#amount").val();
        var username= $("#userN").val();
        var destination = $("#destination").val();
        var theUrl="http://52.89.116.249/~francis.kornu/carpool/create.php?cmd=4&numAllow="+numberAllow+"&date="+date+"&location="+location+"&time="+time+"&amount="+amount+"&destination="+destination;
        $.ajax(theUrl,
					{
					async:true,
					complete:createComplete}
					);
	}

	function createComplete(xhr,status){
		if(status!="success"){
			alert("The system encounted a problem");
				window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
				}
						
				var obj=$.parseJSON(xhr.responseText);
				if (obj.result==0){
				alert("Error. You were not able to create a new Pool");	
				return;
				}else if (obj.result==2){
					alert("Sorry. You can not create a pool with the USERNAME you typed. Please use your USERNAME");
				}else{
					alert("Pool successfully created");
					window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
				}
	}

	function displayNews(){
		var theUrl="http://52.89.116.249/~francis.kornu/carpool/allPhp.php?cmd=5";
		$.ajax(theUrl,
			{
			async:true,
			complete:displayNewsComplete	
			});
		}
	
	function displayNewsComplete(xhr,status){
		

	}	

	function join(pID,Owner){
		var theUrl="http://52.89.116.249/~francis.kornu/carpool/join.php?poolId="+pID+"&owner="+Owner;
		$.ajax(theUrl,
					{
					async:true,
					complete:joinComplete}
					);
	}

	function joinComplete(xhr,status){
		if(status!="success"){
			alert("Error");
					return;
				}
						
				var obj=$.parseJSON(xhr.responseText);
				if (obj.result==0){
					alert("You were not able to join this Pool");
				return;
				}else if (obj.result==3){
					alert("This Pool has the number of members needed. Please join another pool or create a new one. Thank you");
					window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
				}else if (obj.result==4){
					alert("You can not join a pool you created!!");
					window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
				}else if (obj.result==2){
					alert("You can not join a pool, because you have already joined this pool.!!");
					window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
				}else{
					 alert("Pool successfully joined");
					 window.location="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
				}
	}

	function loginComplete(xhr,status){
			if(status!="success"){
						alert("Error");
						return;
					}

			 var block=$.parseJSON(xhr.responseText);
			 if (block.result==0){
			 	document.getElementById('display').innerHTML ="USERNAME OR PASSWORD IS WRONG";
				 }else{
			 window.location ="http://52.89.116.249/~francis.kornu/carpool/dashboard.html";
		}
	}

	function login(){
		var username=$("#username").val();
		var password=$("#password").val();
		var theUrl="http://52.89.116.249/~francis.kornu/carpool/allPhp.php?cmd=1&username="+username+"&password="+password;
		$.ajax(theUrl,
					{
					async:true,
					complete:loginComplete}
					);
	}