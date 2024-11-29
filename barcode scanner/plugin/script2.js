function typeEffect(element, speed) {
  var text = element.innerHTML;
  element.innerHTML = "";

  var i = 0; // Character index
  var timer = setInterval(function() {
      if (i < text.length) {
          if (text.substr(i, 4) === '<br>') {
              element.innerHTML += '<br>';
              i += 4;
          } else {
              element.innerHTML += text.charAt(i);
              i++;
          }
      } else {
          document.getElementById('hidden-text').style.display = 'block';
          clearInterval(timer);
          document.addEventListener('click', function() {
              window.history.back();
          });
      }
  }, speed);
}
var speed = 30;
var p = document.querySelector('p');

p.style.display = "inline-block";
typeEffect(p, speed);
