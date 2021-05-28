
$( "#update_construction" ).submit(function( event ) {
    event.preventDefault(); 
    company_name = ("#owner_name").value;
    company=('#company').value;
    state=$('#state').find(":selected").text();
    city=$('#city').find(":selected").text()
    profession=$('#profession').find(":selected").text()

});

var cityjson;
var profession=['Plumber',"Carpentor","Electrician","Workers","Designer","Arcitect"];
var materials=['Bricks','Paints','Plumbing materials','Hardwares',"Designer",'Tiles'];
$.getJSON( "assets/json/cities.json", function( data ) {
     cityjson=data
});

if($('#state').length){
    append_select(Object.keys(cityjson),"state");
}

append_select(profession,"profession");
append_select(materials,"material");
$("#state").change(function()
{
    $('#city').children().remove();
    append_select(cityjson[this.value],'city');
});



if($('#state').find(":selected").text().length)
{
    append_select(cityjson[$('#state').find(":selected").text()],'city');
}

function append_select(array,id)
{
    $(array).each(function( key, value ) {
        $('#'+id).append(new Option(value, value));
      });
}
  
