$('document').ready(function () {
	// Credit function to dynamically generated the cards on the index page
	function cardloading() {
		// is Ajax method to retrieve the Json file
		$.ajax({
			url: 'ppl.json',
			type: 'get',
			dataType: 'JSON',
			cache: false,
			success: function (data) {
				// upon successfully retrieving the json file loop through the data dynamically generate cards on the index page
				$.each(data, function (index, value) {
					console.log(index);
					console.log(value);
					$('#profile').append(`
						<div class="person" id="p${value.id}">
							<h3> ${value.id} </h3>
							<div class="profileImage">
								<img src="img/${value.id}.jpg">
							</div>
							<h4>Name: ${value.name}</h4>
							<p>Gender: ${value.gender}</p>
						</div>
					`);
				});
			}
		});
	};

// execute the function I just created on page load
	cardloading();

// upon form submission remove all the cards on the  index page
// Post the data from the form to my PHP which will update for Json file
// upon success rerun the function to dynamically generated the cards on the next page
	$("form").submit(function (e) {
		$('.person').remove();
		var fd = new FormData($(this)[0]);
		$.ajax({
			url: "ajaxprocess.php",
			type: "POST",
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			success: function(){
				cardloading();
			}
		});
		e.preventDefault();
	});
});
