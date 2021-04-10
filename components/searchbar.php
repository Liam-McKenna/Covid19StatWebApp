<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<input type="text" name="searchBar" id="searchBar" placeholder="search for country" />

<div id="outputsearch"></div>

<script>
    $(document).ready(function() {
        const searchbar = document.getElementById('searchBar');
        searchbar.addEventListener('keyup', (e) => {
            console.log(e.target.value);
            $.ajax({
                url: './components/sbComponent.php',
                type: 'post',
                data: {
                    "searchEntry": e.target.value
                },
                success: function(response) {
                    console.log(response);

                    document.getElementById("outputsearch").innerHTML = `<p>${response}</p>`;
                }
            });


        });

    })
</script>


<!-- <form action="" method="POST">
    <p>Enter Country Name: </p>
    <input type="text" name="search" value="">
    <input type="submit" name="SearchSubmit" value="Search">
</form>

<?php


// if (isset($_POST['SearchSubmit'])) {
//     $country =  $_POST['search'];
//     $_POST = array();

//     //header()

//     echo "
//     <script>
//     parent.self.location = \"singleCountry.php?countryCode=ie&countryName=" . $country . "\";
//     </script>
//     ";
// }

?> -->