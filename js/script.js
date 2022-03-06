var moreInformationFinans = document.getElementById("more-information-finans")
var finansContent = document.getElementById("finans-content")
moreInformationFinans.addEventListener("click", function(){ 
    finansContent.classList.toggle("hide")
})

var moreInformationSpotify = document.getElementById("more-information-spotify")
var spotifyContent = document.getElementById("spotify-content")
moreInformationSpotify.addEventListener("click", function(){ 
    spotifyContent.classList.toggle("hide")
})
