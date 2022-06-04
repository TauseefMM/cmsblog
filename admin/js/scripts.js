    
$(document).ready(function() {
   //summernote text editor 
   $('#summernote').summernote({
      height: 300,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      focus: true                  // set focus to editable area after initializing summernote
   });
    
  // Bulk_check
    
    $('#selectAllBoxes').click(function(event){
       if(this.checked){
           $('.checkBoxes').each(function(){
              this.checked = true; 
           });
       } else{
           $('.checkBoxes').each(function(){
              this.checked = false; 
           });
       }
    });
    
    var div_box = "<div id='load-screen'><div id='loading'></div></div>"; 
    $("body").prepend(div_box);
    $('#load-screen').delay(700).fadeOut(600,function(){
        $(this).remove();                                     
    });
});


