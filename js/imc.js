function compute() {
	var poids = document.getElementById('Weight'),
		hauteur = document.getElementById('Height');
	var imcAff = document.getElementById('IMC');
	imc = poids.value /((hauteur.value/100)*(hauteur.value/100)) ;
	var imc2 = Math.round(imc*100)/100;
	imcAff.value = imc2;
} 
