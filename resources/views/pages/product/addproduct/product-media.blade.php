<div class="card mb-6">
  <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0 card-title">Product Thumbnail Image</h5>
  </div>
  <div class="card-body">
      <form action="/upload" class="dropzone needsclick p-0" id="dropzone-basic">
          <div class="dz-message needsclick">
              <span class="note needsclick btn btn-sm btn-label-primary" id="btnBrowse">Browse image</span>
          </div>
          <div class="fallback">
              <input name="file" type="file" />
          </div>
          <div id="thumbnail-container" class="mt-3" style="display: none;">
              <img id="thumbnail" src="" alt="Thumbnail" style="max-width: 100%; height: auto;" />
          </div>
      </form>
  </div>
</div>

<!-- Include Dropzone CSS and JS -->
<!-- Include Dropzone CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
<script>
  Dropzone.options.dropzoneBasic = {
    acceptedFiles: 'image/*',
    maxFilesize: 5, // MB
    thumbnailWidth: 200,
    thumbnailHeight: 200,
    init: function () {
      var myDropzone = this;

      this.on("success", function (file, response) {
        // Display the thumbnail container when an image is uploaded
        document.getElementById('thumbnail-container').style.display = 'block';

        // Set the thumbnail image source
        var thumbnailElement = document.getElementById('thumbnail');
        thumbnailElement.src = URL.createObjectURL(file);
      });

      this.on("addedfile", function (file) {
        // Append a custom remove button to the file preview
        var removeButton = Dropzone.createElement('<a href="#" class="dz-details">Delete</a>');
        var _this = this; // Reference to Dropzone instance

        // Listen to click event on remove button
        removeButton.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();

          // Remove the file
          _this.removeFile(file);
        });

        // Append the remove button to the file preview element
        file.previewElement.appendChild(removeButton);
      });

      this.on("removedfile", function (file) {
        // Hide the thumbnail container if no files are present
        if (myDropzone.getAcceptedFiles().length === 0) {
          document.getElementById('thumbnail-container').style.display = 'none';
        }
      });

      this.on("error", function (file, response) {
        console.log('Error:', response);
      });
    }
  };
</script>
