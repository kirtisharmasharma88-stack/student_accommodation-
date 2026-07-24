<?php

echo "Added to Interested List Successfully ❤️";

?>
<button onclick="addInterest()" class="btn btn-danger">
❤️ Interested
</button>

<p id="message"></p>


<script>

function addInterest(){

fetch("ajax_interest.php")
.then(response => response.text())
.then(data => {

document.getElementById("message").innerHTML = data;

});

}

</script>