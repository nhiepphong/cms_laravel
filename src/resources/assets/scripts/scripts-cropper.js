$(function() {
  setTimeout(function(){ initCropImage(); }, 500);
});

function initCropImage() 
{
  var $image = $(".cropper"),
      $dataHeight = $("#dataHeight"),
      $dataWidth = $("#dataWidth"),
      console = window.console || {log:$.noop},
      cropper;

  $image.cropper({
    aspectRatio: widthImageCrop / heightImageCrop,
     //autoCropArea: 1,
    data: {
      x: 420,
      y: 50,
      width: widthImageCrop,
      height: heightImageCrop
    },
    preview: ".preview",

    // multiple: true,
    // autoCrop: false,
    // dragCrop: false,
    // dashed: false,
    // modal: false,
    // movable: false,
    // resizable: false,
    // zoomable: false,
    // rotatable: false,
    // checkImageOrigin: false,

    // maxWidth: 480,
    // maxHeight: 270,
    // minWidth: 160,
    // minHeight: 90,

    done: function(data) {
      $dataHeight.val(data.height);
      $dataWidth.val(data.width);
    },

    build: function(e) {
      console.log(e.type);
    },

    built: function(e) {
      console.log(e.type);
    },

    dragstart: function(e) {
      console.log(e.type);
    },

    dragmove: function(e) {
      console.log(e.type);
    },

    dragend: function(e) {
      console.log(e.type);
    }
  });

  cropper = $image.data("cropper");

  $image.on({
    "build.cropper": function(e) {
      console.log(e.type);
      // e.preventDefault();
    },
    "built.cropper": function(e) {
      console.log(e.type);
      // e.preventDefault();
    },
    "dragstart.cropper": function(e) {
      console.log(e.type);
      // e.preventDefault();
    },
    "dragmove.cropper": function(e) {
      console.log(e.type);
      // e.preventDefault();
    },
    "dragend.cropper": function(e) {
      console.log(e.type);
      // e.preventDefault();
    }
  });

  $("#reset").click(function() {
    $image.cropper("reset");
  });

  $("#rotateLeft").click(function() {
    $image.cropper("rotate", -90);
  });

  $("#rotateRight").click(function() {
    $image.cropper("rotate", 90);
  });

  var $inputImage = $("#inputImage");

  if (window.FileReader) {
    $inputImage.change(function() {
      var fileReader = new FileReader(),
          files = this.files,
          file;

      if (!files.length) {
        return;
      }

      file = files[0];

      if (/^image\/\w+$/.test(file.type)) 
      {
        fileReader.readAsDataURL(file);
        fileReader.onload = function () 
        {
          $image.cropper("reset", true).cropper("replace", this.result);
          $inputImage.val("");
        };

        jQuery('#ultraModal-7').modal('show', {backdrop: 'static'});
      } 
      else 
      {
        showMessage("Please choose an image file.");
      }
    });
  } 
  else 
  {
    $inputImage.addClass("hide");
  }

  $("#getDataURL").click(function() {
    var dataURL = $image.cropper("getDataURL", {
      width: widthImageCrop,
      height: heightImageCrop
    });
    $("#preview_" + nameElement).attr("src", dataURL);
    $("#" + nameElement).val(dataURL);

    $('#ultraModal_' + nameElement).modal('hide');
    $('#ultraModal_'+nameElement+' .modal-body').html("");
  });

}
