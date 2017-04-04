$(document).ready(function() {
	$('#pdf_image').on('change', function() {
		$(this).siblings('.error').hide();
	});

	$('#pdf_date').on('change', function() {
		$(this).siblings('.error').hide();
	});

	function readURL(input) {
		if(input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('.preview-pdf-img').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$('.error .closeBtn').on('click', function() {
		$(this).parent().hide();
	});

	$('#pdf_date').on('dp.change', function(e) {
		console.log(e.date);
	});

	function highlightDays(month, day) {
		$('.calendar-day').removeClass('highlighted');
		for(i = month; i <= 12; i++) {
			if(day == 31) {
				if($('.calendar-day.day-' + i + '-' + day).length == 0) {
					$('.calendar-day.day-' + i + '-' + (day - 1)).addClass('highlighted');
				} else {
					$('.calendar-day.day-' + i + '-' + day).addClass('highlighted');
				}
			} else {
				$('.calendar-day.day-' + i + '-' + day).addClass('highlighted');
			}
		}
	}

	$('#preview').on('click', function() {
		$('.preview-layout .preview-pdf-container').slideUp();		
		$('.preview-layout .preview-loading-overlay').slideDown();

		window.setTimeout(function() {
			readURL(document.getElementById('pdf_image'));

			if($('#pdf_date').val()) {
				var chosenDate = new Date($('#pdf_date').val());
				highlightDays(chosenDate.getMonth() + 1, chosenDate.getDate());
			}

			$('.preview-layout .preview-loading-overlay').slideUp();
			$('.preview-layout .preview-pdf-container').slideDown();
		}, 2000);
	});

	$('.btn-save').on('click', function() {
		if(!validateFields()) {
			return false;
		}
		
		var chosenDate = new Date($('#pdf_date').val());

    $('#pdf_date_month').val(chosenDate.getMonth() + 1);
    $('#pdf_date_day').val(chosenDate.getDate());
    $('#pdf_form').submit();
	});

	function validateFields() {
		var isValid = true;
		if(!$('#pdf_image').val()) {
			isValid = false;
			$('#pdf_image').siblings('.error').slideDown();
		}
		if(!$('#pdf_date').val()) {
			isValid = false;
			$('#pdf_date').siblings('.error').slideDown();	
		}
		if(!isValid) {
			$('body').scrollTop(0);
		}
		return isValid;
	}
})