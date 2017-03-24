function isnum(obj, maxpt) {

	if (isNaN(obj.value) || parseInt(obj.value)<0 || parseInt(obj.value) > maxpt || parseInt(obj.value) > 200 || parseInt(obj.value)%10!=0){
	alert('Errore nei dati immesi!\nNel campo è possibile immettere solo un numero multiplo di 10 minore o uguale ai punti disponibili (massimo 200 punti)!');
	obj.value="0";
	obj.focus();
	}
}