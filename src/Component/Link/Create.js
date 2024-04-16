(function() {
	document.querySelectorAll('input[type="url"]').forEach(function(input) {
		input.addEventListener('change', function() {
			var string = this.value;
			if (!string.trim()) return;
			if (string.indexOf("http") === -1) {
				string = "https://" + string;
				this.value = string;
			}
		});
	});
})();