$(function() {

	$('#urlType-label').hide();

	//$('#deeplink-massdel-run').button();

	loadDeeplinksList();

	var urlDropDown = $('#url');
	var urlLabel    = $('#url-label').find('label');
	$('#urlType-0').click(function() {
		$('#url').replaceWith(urlDropDown);
	})
	$('#urlType-1').click(function(){
		$('#url').replaceWith('<input type="text" id="url" name="url" value="http://" />');
	})

	$('#chk-all').click(function() {
		 $('.deeplink-massdel').attr('checked', ($(this).attr('checked')) ? true : false);
	})

	 $('.deeplink-massdel').on('click', function() {
		if(!$('.deeplink-massdel').not(':checked').length) {
			$('#chk-all').attr('checked', true);
		}
		else {
			$('#chk-all').attr('checked', false);
		}
	 })

	$('#deeplink-massdel-run').click(function() {
		var ids = [];
		$('.deeplink-massdel:checked').each(function() {
			ids.push($(this).attr('id'));
		});
		if(!ids.length) {
			showMessage('Select at least one item, please', true);
			return false;
		}
		showConfirm('You are about to remove one or many deeplinks. Are you sure?', function() {
			var callback = $('#frm-deeplinks').data('callback');
			$.ajax({
				url: $('#website_url').val() + 'backend/backend_seo/removedeeplink/',
				type: 'post',
				data: {
					id: ids
				},
				dataType: 'json',
				beforeSend: function() {showSpinner();},
				success: function(response) {
					hideSpinner();
					showMessage(response.responseText, response.error);
					if(typeof callback != 'undefined') {
						eval(callback + '()');
					}
				}
			});
		});
	});
});

function loadDeeplinksList() {
	showSpinner();
	$.getJSON($('#website_url').val() + 'backend/backend_seo/loaddeeplinkslist/', function(response) {
		$('#deeplinks-list').html(response.deeplinksList);
		hideSpinner();
	})
}