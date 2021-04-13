<input type="text" name="searchBar" id="searchBar" placeholder="search for country" />

<div id="outputsearch"></div>

<script>
    //when the window loads, this adds an event listener for any changes to the searchbar input and loads in new php country data with ajax. There is a default ajax to load in all the countries since the input is empty by default.
    $(window).on('load', function() {
        const searchbar = document.getElementById('searchBar');
        console.log(searchbar);
        // event listener for when changes happen to the input
        searchbar.addEventListener('keyup', (e) => {
            console.log(e.target.value);
            $.ajax({
                url: './components/sbComponent.php',
                type: 'post',
                data: {
                    "searchEntry": e.target.value
                },
                success: function(response) {
                    //console.log(response);
                    document.getElementById("outputsearch").innerHTML = `<p>${response}<p>`;
                }
            });
        });

        //default load the php country data without anything entered.
        $.ajax({
            url: './components/sbComponent.php',
            type: 'post',
            data: {
                "searchEntry": "",
                "currentPage": <?PHP echo $_GET['page']; ?>
            },
            success: function(responseDefault) {
                //console.log(responseDefault);
                document.getElementById("outputsearch").innerHTML = `<p>${responseDefault}<p>`;
            }
        });

        // ajax complete will wait until the Ajax php is in the dom before running this script, since the page id will not exist until after the ajax call is complete.
        $(document).ajaxComplete(function(event, request, settings) {
            let pageNumber = <?php echo $_GET['page'] ?>;
            if (pageNumber && document.getElementById("page" + pageNumber)) {
                pageId = document.getElementById("page" + pageNumber);
                pageId.style.color = "var(--Cpink)";
            }
        });
    })

    // this function is for each button on each Country card. when the button is clicked, it will pass the country code and country name to this function andthis function will redirect to the focus country page with the identifiers for that selected country.
    function loadCountry(countryCode, countryName) {
        document.cookie = 'selectedCountry=' + countryCode;
        window.location.href = `singleCountry.php?countryCode=${countryCode}&countryName=${countryName}`;
    }
</script>