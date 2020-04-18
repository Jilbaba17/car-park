
setInterval(function() {
  refreshSlots();
}, 1000 * 60 * 0.25);

function refreshSlots() {
	var req = $.ajax({
        type:"get",
        url:"site/index",
        data:{ajax:1}
    });
	req.done(function(data) {
		$('.info-box-number').html(data.takenSpaces + " / " + data.companySpaces);
		$('.progress-bar').css('width', data.parkingAvailablePercentage + '%');
		$('.progress-description').html(data.parkingAvailablePercentage + '% Full')
	})
	
}
refreshSlots();