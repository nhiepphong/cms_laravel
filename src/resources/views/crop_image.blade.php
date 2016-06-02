<link href="{{ $assetURL }}plugins/image-cropper/css/cropper.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/image-cropper/css/docs.css" rel="stylesheet" type="text/css" media="screen"/>   

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-left:0px;padding-left:0px;">

        <!-- start -->

        <div class="col-xs-12 col-sm-8 col-md-8" style="margin-left:0px;padding-left:0px;">
            <div>
                <img style="display:none;"class="cropper" src="<?=$link?>" alt="Picture">
            </div>
            <div class="clearfix"></div><br>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="eg-preview clearfix">
                <div class="preview preview-lg"></div>
            </div>
            <div class="eg-button" style="width:305px;">
                <button class="btn btn-info" id="rotateLeft" type="button">Rotate Left</button>
                <button class="btn btn-info  pull-right" id="rotateRight" type="button">Rotate Right</button>
                <br><div class="clearfix"></div>
            </div>
            <div class="eg-button" style="width:305px;">
                <label class="btn btn-purple" for="inputImage" title="Upload image file">
                    <input class="hide" id="inputImage" name="file" type="file" accept="image/*">
                    Upload File
                </label>
                <button class="btn btn-purple pull-right" id="getDataURL" type="button">Apply</button>
                <br><div class="clearfix"></div>
            </div>
        </div>

        <br><div class="clearfix"></div><br>
        <!-- end -->

    </div>
</div>
<script type="text/javascript">
var widthImageCrop = <?=$width?>;
var heightImageCrop = <?=$height?>;
var nameElement = "<?=$name?>";
</script>
<script src="{{ $assetURL }}plugins/image-cropper/js/cropper.js" type="text/javascript"></script>
<script src="{{ $assetURL }}scripts/scripts-cropper.js" type="text/javascript"></script>