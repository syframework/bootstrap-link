(function() {
	$('input[type="url"]').change(function() {
		var string = this.value;
		if (!string.trim()) return;
		if (!~string.indexOf("http")) {
			string = "http://" + string;
			this.value = string;
		}
	});
})();