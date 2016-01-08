function upload_image(file, img_tag) {
  $.ajaxFileUpload({
    url:'/m/api/misc.php?mod=upload_image',
    secureuri:false,
    fileElementId:file,
    dataType:'json',
    success:function(data) {
      if(data.status == 0) {
        $(img_tag).attr("src", data.path);
      } else {
        alert(data.message);
      }   
    },  
    error: function(data) {
        alert("error");
    }   
  }); 
}
