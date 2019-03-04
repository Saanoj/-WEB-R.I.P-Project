var startInterprete = document.getElementById("startInterprete");
var valueSpan = document.getElementById("value");

startInterprete.addEventListener("input", function() {
  valueSpan.innerText = startInterprete.value;
}, false);