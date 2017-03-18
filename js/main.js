
$(document).ready(function() {
  $('#url').submit(function(){
    var urlData = $(this).serialize();
    $.post('core/run.php', urlData, processData).error('ой');
    function processData(data){
      // $('#result-data').html('<p>'+data+'</p>');
      $('.result-data').html(data);
      }
  return false;
  });   
});
