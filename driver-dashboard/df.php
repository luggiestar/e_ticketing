<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">

select {
    
 width: 300px;
    
}

</style>
<script src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    // $('body').hide();
    $('#route').on('change',function(){
        var route_id = $(this).val();
        if(route_id){
            $.ajax({
                type:'POST',
                url:'ajaxFile.php',
                data:'route_id='+route_id,
                success:function(html){
                    $('.station').html(html);
                }
            }); 
        }else{
            $('.station').html('<option value="">Select Route first</option>');
        }
    });
    
});
</script>
</head>
<body>
<center>

                
    <div style='margin-top:50px;'>
	
  

    

    </div>
	</center>
</body>
</html>


