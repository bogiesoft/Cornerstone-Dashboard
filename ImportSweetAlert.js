$(document).ready(function () {
$('input.inputbutton').click(function(e) {
  e.preventDefault();
  var btn = "button";
  swal({
    title: "HTML <small>Consultation Review</small>!",
    text: '<button type="' + btn + '" id="btnA" >A</button> ' +
      '<button type="' + btn + '" id="btnB" >B</button> ' +
      '<button type="' + btn + '" id="btnC" >C</button>',
    html: true,
    showConfirmButton: false
  });
});
$(document).on('click', "#btnA", function() {
  alert(this.id);
});

$(document).on('click', "#btnB", function() {
  alert(this.id);
});

$(document).on('click', "#btnC", function() {
  alert(this.id);
});
});
