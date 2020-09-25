// Docs & References
// https://en.wikipedia.org/wiki/Special:Random
// https://www.mediawiki.org/wiki/API:Main_page

var searchBar = document.getElementById('text1');
var submitBtn = document.getElementById('bt');
var query = searchBar.value;

// var api = "https://it.wikipedia.org/w/api.php?action=query&origin=*&format=json&generator=search&gsrnamespace=0&gsrlimit=35&gsrsearch="
var api ="https://it.wikipedia.org/w/api.php?action=query&format=json&origin=*&list=search&srsearch=";
// var cb = '&callback=JSON_CALLBACK';
var url = ''; // Set url from outside addEventListener function

submitBtn.addEventListener('click', function(e) { // Listen for click on submit button

    $("#searchResults").empty(); // Clear search results

    e.preventDefault(); // Prevent default behavior of submit button

    var apiUrl = api + "%27" + searchBar.value.replace(/[\s]/g, '_') + "%27"; // Replace whitespaces with underscores

    // console.log(apiUrl);
    // console.log('User Query:', searchBar.value); // Log the users search query
    searchBar.value = ''; // Clear search bar
    url = apiUrl; // Set url to apiUrl
    searchResults(apiUrl); // Call searchResults, passing in the apiUrl
});

document.addEventListener('keypress', function (e) { // Listen for pressing enter 

    if (e.key === 'Enter') {
        $("#searchResults").empty(); // Clear search results

        e.preventDefault(); // Prevent default behavior of submit button

        var apiUrl = api + "%27" + searchBar.value.replace(/[\s]/g, '_') + "%27"; // Replace whitespaces with underscores

        // console.log(apiUrl);
        // console.log('User Query:', searchBar.value); // Log the users search query
        searchBar.value = ''; // Clear search bar
        url = apiUrl; // Set url to apiUrl
        searchResults(apiUrl); // Call searchResults, passing in the apiUrl
      }
});

function searchResults(url) {

    $.ajax({
        url: url,
        success: function(result) {

            //console.log('Result:', result); // Returns full result object
            //console.log('Pages:', result.query.pages); // Returns result pages within result object

            for (var i in result.query.search) { // Loop through all pages within result object

                // console.log(result.query.pages[i].title);
                var searchResults = document.getElementById('searchResults');
                var resultsLi = document.createElement('li'); // Create li element for all page titles

                // resultsLi.className = 'singleResult'; // Add class to all li elements
                resultsLi.className = 'list-group-item list-group-item-action';
                //resultsLi.style.display = 'none'; // Hide li by default
                resultsLi.innerHTML = '<p>' + result.query.search[i].title + '</p>'; // Add title text to lis
                searchResults.appendChild(resultsLi); // Append lis to searchResults div

            
                
                // $(resultsLi).wrap(function() { // Wrap li with corresponding wiki url
                //    // return '<a target="_blank" href="https://it.wikipedia.org/wiki/' + result.query.pages[i].title + '"></a>';
                //    return '<a id="'+ result.query.pages[i].title +'"></a>';
                // });

                // $(resultsLi).on("click", function(){
                //     return search(result.query.pages[i].title);

                // });
                $(resultsLi).attr("id", i);

                
                
                
               


                // $(resultsLi).fadeIn(1000); // Fade in hidden lis
            }

            var listItems = $("#searchResults li");
            listItems.each(function(idx, li) {
                var product = $(li);

                $(product).on("click", function(){
                    search(result.query.search[$(product).attr('id')].title);
                    //if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
                        // console.log('si è uno smartphone');
                        // true for mobile device
                    document.getElementById('searchResults').style.display = 'none'; 
                     //} levare questo commento se viene levato il commento all'if   
                });

                // and the rest of your code
            });


            // document.getElementById(result.query.pages[i].title).on("click", function(){
            //     search(result.query.pages[i].title);
            // });
            document.getElementById('searchResults').style.display = 'block';

        }
    });
};
