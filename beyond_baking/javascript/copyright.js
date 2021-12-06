// Copyright

function copyrightStatement() {
	const currDate = new Date();
	let currYear = currDate.getFullYear();
	
	document.querySelector("#copyright").innerHTML = "Copyright &copy " + currYear + " Stephanie Thompson All Rights Reserved <br> Beyond Baking is not a real business. The business and website were created for the purpose of education in web development."
}

