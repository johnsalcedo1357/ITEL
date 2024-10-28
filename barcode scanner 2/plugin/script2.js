function typeEffect(element, speed) {
	var text = element.innerHTML;
	element.innerHTML = "";
	
	var i = 0;
	var timer = setInterval(function() {
    if (i < text.length) {
      element.append(text.charAt(i));
      i++;
    } else {
      document.getElementById('hidden-text').style.display = 'block';
      clearInterval(timer);
      document.addEventListener('click', function() {
        window.history.back(); // go back to the previous page
    });
    }
  }, speed);
}

var speed = 30;
var p = document.querySelector('p');

p.style.display = "inline-block";
  typeEffect(p, speed);