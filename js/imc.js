function compute() {
	var poids = document.getElementById('Weight'),
		hauteur = document.getElementById('Height');
	var imcAff = document.getElementById('IMC');
	imc = poids.value /((hauteur.value/100)*(hauteur.value/100)) ;
	imcAff.value = Math.round(imc*100)/100;;
} 
