<div id="wrapper">
    <section id="core">
        <div class="profileinfo">

            <div class="gear">
                <label>Primary E-Mail:</label><br />
                <span id="pemail" class="datainfo">myaddress@googlemail.com</span>
                <a href="#" class="editlink">Edit Info</a>
                <a class="savebtn">Save</a>
            </div>

            <div class="gear">
                <label>Full Name:</label><br />
                <span id="first" class="datainfo">Johnny</span>
                <span id="middle" class="datainfo">James</span>
                <span id="last" class="datainfo">Appleseed</span>
                <a href="#" class="editlink">Edit Info</a>
                <a class="savebtn">Save</a>
            </div>

            <div class="gear">
                <label>Birthday:</label><br />
                <span id="birthday" class="datainfo">August 21, 1989</span>
                <a href="#" class="editlink">Edit Info</a>
                <a class="savebtn">Save</a>
            </div>

            <div class="gear">
                <label>Address:</label><br />
                <span id="address1" class="datainfo">123 Test Lane</span><br />
                <span id="address2" class="datainfo">APT 104</span><br />
                <span id="city" class="datainfo">Anywhere</span>
                <span id="state" class="datainfo">FL</span>
                <span id="zip" class="datainfo">55555</span>
                <a href="#" class="editlink">Edit Info</a>
                <a class="savebtn">Save</a>
            </div>

            <div class="gear">
                <label>Occupation:</label><br />
                <span id="occupation" class="datainfo">Freelance Web Developer</span>
                <a href="#" class="editlink">Edit Info</a>
                <a class="savebtn">Save</a>
            </div>
        </div>
    </section>
</div>
<?php include "includehtml/footer.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $(".editlink").on("click", function(e){
    e.preventDefault();
    var datasets = $(this).prevAll(".datainfo");
    var savebtn = $(this).next(".savebtn");
    datasets.each(function(){
      var theid   = $(this).attr("id");
      var newid   = theid+"-form";
      var currval = $(this).text();
      $(this).html('<input type="text" name="'+newid+'" id="'+newid+'" value="'+currval+'" class="hlite">');
    });

    $(this).css("display", "none");
    savebtn.css("display", "block");
  });

  $(".savebtn").on("click", function(e){
    e.preventDefault();
    var elink   = $(this).prev(".editlink");
    var datasets = $(this).prevAll(".datainfo");
    datasets.each(function(){
      var newid   = $(this).attr("id");
      var einput  = $("#"+newid+"-form");
      var newval  = einput.val();
      einput.remove();
      $(this).html(newval);
    });

    $(this).css("display", "none");
    elink.css("display", "block");
  });
});
</script>