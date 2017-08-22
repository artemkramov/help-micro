var App = (function() {

	var form = "#form-hex";

	var fileInputID = "file-hex";

	var alertTemplate = "#template-alert";

	var alertBlock = "#alert-message";

	var fileInput = "#" + fileInputID;

	return {
		currentFile: "",
		init: function() {
			this.events();
		},
		events: function() {

			var self = this;
			
			$(document).ready(function() {

				$(document).on("change", fileInput, function () {
					self.readFileData().done(function(fileText) {
						self.currentFile = fileText;
					});
				});

				$(document).on("click", fileInput, function() {
					$(this).val("");
					this.currentFile = "";
				});
				
				$(form).submit(function() {
					if (self.isFileValid()) {
						var formData = new FormData();
						formData.append('file-hex', $(fileInput)[0].files[0]);
						$("body").addClass("uploading");
						self.updateProgressBar(0);
						$.ajax({
						       url : 'upload.php',
						       type : 'POST',
						       data : formData,
						       processData: false,  // tell jQuery not to process the data
						       contentType: false,  // tell jQuery not to set contentType
						       xhr:         function () {
									var xhr = new window.XMLHttpRequest();
									xhr.upload.addEventListener("progress", function (evt) {
										if (evt.lengthComputable) {
											var percentComplete = Math.round(evt.loaded * 100 / evt.total);
											self.updateProgressBar(percentComplete);
										}
									}, false);

									return xhr;
								},
						       success : function(data) {
						       	$("body").removeClass("uploading");
						           if (_.isObject(data)) {
						           		self.pushMessage(data.text, data.isError ? 'danger' : 'success');
						           }					           
						       },
						       error: function() {
						       		$("body").removeClass("uploading");
						       		self.pushMessage('Ошибка соединенния', 'danger');
						       }
						});
					}
					else {
						self.pushMessage('Неверный формат файла', 'danger');
					}
					return false;
				});

			});
		},
		/**
		 * Read data from the file input to string
		 * @param deferred
		 */
		readFileData:            function () {
			var deferred = $.Deferred();
			var input = document.getElementById(fileInputID);
			var file  = input.files[0];
			var fr    = new FileReader();
			fr.onload = function (event) {
				deferred.resolve(event.target.result);
			};
			if (file) {
				fr.readAsText(file);
			}
			else {
				this.currentFile = "";
			}
			return deferred.promise();
		},
		isFileValid: function() {
			var isValid = false;
			var lines = this.currentFile.split("\r\n");
			if (_.isEmpty(this.currentFile) || lines.length < 6) {
				return false;
			}
			lines.splice(0, 3);
			lines = _.compact(lines);
			lines.splice(lines.length - 2, 1);
			try {
				var tmpBinaryData = IntelHex.parseIntelHex(lines.join("\r\n"));
				isValid = true;
			}
			catch(e) {}
			return isValid;
		},
		pushMessage: function(message, type) {
			var template = $(alertTemplate).clone().find('.alert');
			$(template).addClass('alert-' + type);
			$(template).find('.alert-content').html(message);
			$(alertBlock).html(template);
		},
		updateProgressBar: function(value, name) {
			var progressBar = $(".progress-bar");
			var percentage  = value + '%';
			$(progressBar).css({
				width: percentage
			});
			$(progressBar).text(percentage);
			if (!_.isUndefined(name)) {
				$("#progress-title").text(name);
			}
		}
	};
})();
App.init();