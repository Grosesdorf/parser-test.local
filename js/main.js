
document.addEventListener("DOMContentLoaded",function() {
  var mybutton = document.getElementById('submitBtn');
  mybutton.addEventListener("click", function(){
    var url = document.getElementById('url').value;
    url = 'url=' + encodeURIComponent(url);
    var request = new XMLHttpRequest();
    request.open('POST','core/run.php',true);
    request.addEventListener('readystatechange', function() {
      if ((request.readyState==4) && (request.status==200)) {
        console.log(request);
        console.log(request.responseText);
        var result = document.getElementById('result-data');
        result.innerHTML = request.responseText;
      }
    });
    
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(url);
  });
});