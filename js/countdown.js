var countDownDate = new Date("Aug 30, 2020 00:00:00").getTime();

var x = setInterval(function() {
  var now = new Date().getTime();

  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("countdown").innerHTML =
    "Time until <span class='green'>Salad</span> is back: " +
    "<br>" +
    days +
    " <span class='green'>days</span>  " +
    hours +
    " <span class='green'>hours</span>  " +
    minutes +
    " <span class='green'>minutes</span>  " +
    seconds +
    " <span class='green'>seconds</span>";

  if (distance < 0) {
    clearInterval(x);
    document.getElementById("countdown").innerHTML = "OOF";
  }
}, 1000);
