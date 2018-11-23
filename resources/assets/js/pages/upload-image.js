export default class UploadImage {

    init() {
        this.setUploadEvent();
    }

    setUploadEvent() {
        let el = document.getElementById('files');
        if (el) {
            el.onchange = function (evt) {
                var file = this.files[0];

                // FileReader support
                if (FileReader && file) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        // ===== LOAD image from local by blob
                        var urlCreator = window.URL || window.webkitURL;
                        var blob = new Blob([new Uint8Array(fr.result)]);
                        var imageUrl = urlCreator.createObjectURL(blob);

                        // ===== LOAD image from local by base64
                        // var imageUrl = fr.result;

                        var imgHtml = '<img id="img" src="' + imageUrl + '" style="max-width: 300px; max-height: 300px; width: auto; height: auto;" />';
                        var container = document.getElementById('img-container');
                        container.innerHTML = imgHtml;
                    }
                    // fr.readAsDataURL(file); // Read data output base64
                    fr.readAsArrayBuffer(file); // Read data output array buffer
                }

                // Not supported
                else {
                    // fallback -- perhaps submit the input to an iframe and temporarily store
                    // them on the server until the user's session ends.
                }
            };
        }
    }

}