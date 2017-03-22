$(document).ready(function() {
	$('#url').submit(function(){
		var urlData = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "core/run.php",
			data: urlData,
			cache: false,
			success: function (data){
				var result = JSON.parse(data);
				// console.log(result);
				if(!result.ERROR){
					var table = document.createElement('table'),
					tr = table.appendChild(document.createElement('tr'));
					tr.className = "center-text";
					th1 = tr.appendChild(document.createElement('th'));
					th2 = tr.appendChild(document.createElement('th'));
					th3 = tr.appendChild(document.createElement('th'));
					th4 = tr.appendChild(document.createElement('th'));
					th5 = tr.appendChild(document.createElement('th'));
					th1.innerHTML = '&#8470;';
					th2.innerHTML = 'Название проверки';
					th3.innerHTML = 'Статус';
					th4.innerHTML = '&nbsp;';
					th5.innerHTML = 'Текущее состояние';

					var k = 1;

					$.each(result, function( key, value ) {
						if(typeof(value) == 'object'){
							
							tr = table.appendChild(document.createElement('tr'));
							td = tr.appendChild(document.createElement('td'));
				    		td.setAttribute('class', 'center-text');
				    		td.setAttribute('rowspan', '2');
				    		td.innerHTML = k;

				    		var i = 1;

							$.each(value, function( keyTd, valueTd ) {
						    	if(i == 1){
						    		td = tr.appendChild(document.createElement('td'));
						    		td.setAttribute('rowspan', '2');
						    		td.innerHTML = valueTd;	
						    	}
						    	else if(i == 2){
						    		td = tr.appendChild(document.createElement('td'));
						    		td.setAttribute('rowspan', '2');
						    		if(valueTd == true){
						    			td.setAttribute('class', 'success-check center-text');
						    			td.innerHTML = 'OK';
						    		}
						    		else if (valueTd == false){
						    			td.setAttribute('class', 'error-check center-text');
						    			td.innerHTML = 'Ошибка';
						    		}
						    	}
						    	else if(i == 3 || i == 4){	
						    		if(i == 3){
						    			td = tr.appendChild(document.createElement('td'));
							    		td.innerHTML = 'Состояние';
							    		td = tr.appendChild(document.createElement('td'));
							    		td.innerHTML = valueTd;
						    		}
						    		else if(i == 4){
						    			tr = table.appendChild(document.createElement('tr'));
						    			td = tr.appendChild(document.createElement('td'));
						    			td.innerHTML = 'Рекомендации';
							    		td = tr.appendChild(document.createElement('td'));
						    			td.innerHTML = valueTd;
						    		}	
						    	}
						    	i++;
					  		});	
					  		console.log(result);
					    	k++;
						}
					});
					$('.result').html(table);
				}
				else{
					$('.result').html(result.ERROR);
				}
			}	
		});
		return false;
	});
});