(function(){

	var flag = false;

	/*Hides and shows elements*/

 	document.getElementsByClassName("hidder")[0].addEventListener("click", function(){
 		document.getElementsByClassName('hidden')[0].style.display = flag ? "none" : "block";
 		flag = !flag;
 	});

 	let arrayOfupdaters = document.getElementsByClassName("upd");


 	for (var i = 0 ; i < arrayOfupdaters.length; i++) {
 		arrayOfupdaters[i].addEventListener("click", function(){
		 	document.getElementsByClassName('updater')[0].style.display = flag ? "none" : "block";
		 	let id = arrayOfupdaters[i].id;
		 	console.log(id);
		 	document.getElementsByClassName('key')[0].value = id;
		 	flag = !flag;
 		});
 	}

})();