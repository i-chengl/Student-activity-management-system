<?php echo $this->renderPartial('/_include/header')?>
<script type="text/javascript" src="<?php echo $this->_baseUrl?>/static/js/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_baseUrl?>/static/js/uploadify/uploadify.css">
<style>
body { background: #E7EDEF }
</style>

<form>
  <input id="uploadify" name="uploadify" type="file" multiple="true">
  <ul id="fileListWarp">
  </ul>
  <div id="fileQueue" style="clear:both"></div>
</form>
<script type="text/javascript">
		
$(function() {
    $('#uploadify').uploadify({
        'buttonText': '选择文件..',
        'fileObjName': 'imgFile',
        'method': 'post',
        'multi': true,
		'queueID': 'fileQueue',
        /*'uploadLimit': 2,*/
        'fileTypeExts': '*.gif;*.png;*.jpg;*.bmp;',
        'buttonImage': '<?php echo $this->_baseUrl?>/static/js/uploadify/select.png',
        'formData': {
            'sessionId'   : '<?php echo session_id(); ?>',
			'timestamp'   : '<?php echo time();?>',
			'token'       : '<?php echo md5('unique_salt'.time()); ?>'
        },
        'swf': '<?php echo $this->_baseUrl?>/static/js/uploadify/uploadify.swf',
        'uploader': '<?php echo $this->createUrl('uploadify/basicExecute')?>',
        'onUploadStart': function(file) {
            $('#uploadify').uploadify('settings', 'formData', {
                'iswatermark': $("#iswatermark").attr("checked")
            });
        },
        'onUploadSuccess': function(file, data, response) {
            var json = $.parseJSON(data);
            if (json.state == 'success') {
                $("#fileListWarp").append('<li id="image_' + json.fileId + '"><a href="<?php echo $this->_baseUrl?>/' + json.file + '" target="_blank"><img src="<?php echo $this->_baseUrl?>/'+json.file+'" width="40" height="40"  align="absmiddle"/></a>&nbsp;<br /><a href="javascript:uploadifyRemove(&quot;' + json.fileId + '&quot;,&quot;image_&quot;)">删除</a></a><input name="imageList[fileId][]" type="hidden" value="'+json.fileId+'" /><input name="imageList[file][]" type="hidden" value="'+json.file+'"/></li>');
            } else {
                alert(json.message);
            }
        }
    });
});


	</script>

<?php echo $this->renderPartial('/_include/footer')?>