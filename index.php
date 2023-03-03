<html>
<head>
<title>Painting Web Service</title>
<style>
	body {font-family:georgia;}
 
  .film{
      border:1px solid #E77DC2;
      border-radius: 5px;
      padding: 5px;
      margin-bottom:5px;
      position:relative;   
    }
 
 
    .pic{
      position:absolute;
      right:10px;
      top:10px;
    }
 
    .pic img{
	    max-width:50px;
    }
 
 
 
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>
 
<script type="text/javascript">
 
//here we'll parse data from each film:
function bondTemplate(film){
 return `
 <div class="film">
    <b>Title</b>: ${film.Title}<br>
    <b>Year</b>: ${film.Year}<br>
    <b>Artist</b>: ${film.Artist}<br>
    <b>Cost</b>: ${film.Cost}<br>
    <b>Note</b>: ${film.Note}<br>
    <div class="pic"><img src="thumbnails/${film.Image}"></div>
 </div>
   `;
  }

$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
    //clear previous films
   $("#films").html("");
 
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);
     $("#filmtitle").html(data.title);

     $.each(data.films,function(i,item){
      let myData = bondTemplate(item);
      $("<div></div>").html(myData).appendTo("#films"); 
     });

     
     /*
     let myData = JSON.stringify(data,null,4);
     myData = "<pre>" + myData + "</pre>";
     $("#output").html(myData);
     */
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
}); 
 
</script>
</head>
	<body>
	<h1>Painting Web Service</h1>
		<a href="year" class="category">Most Expensive Paintings Purchased By Year</a><br />
		<a href="box" class="category">Expensive Paintings Purchased By Cost</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">
      <!--
      <div class="film">
          <b>Film</b>: 1<br>
          <b>Title</b>: Dr. No<br>
          <b>Year</b>: 1962<br>
          <b>Director</b>: Terence Young<br>
          <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br>
          <b>Writers</b>: Richard Maibaum, Johanna Harwood and Berkely Mather<br>
          <b>Composer</b>: Monty Norman<br>
          <b>Bond</b>: Sean Connery<br>
          <b>Budget</b>: $1,000,000.00<br>
          <b>BoxOffice</b>: $59,567,035.00<br>
          <div class="pic"><img src="thumbnails/dr-no.jpg"></div>
		</div>
      -->
		<div id="output">Results go here</div>
	</body>
</html>
